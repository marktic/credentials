<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions;

use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\MediaLibrary\Media\Media;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/**
 * Generates an inline HTML preview of the submitted credential file.
 *
 * The preview type depends on the file extension:
 *  - Images        : <img> tag
 *  - PDF           : <embed> (full-page)
 *  - Office docs   : Google Docs Viewer iframe
 *  - Video         : <video> tag
 *  - Audio         : <audio> tag
 *  - Plain text    : <pre> block (content read from disk)
 *  - Unknown       : download link
 */
class GenerateFilePreviewHtml extends AbstractAction
{
    use HasSubject;

    private const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'ico'];
    private const PDF_EXTENSIONS = ['pdf'];
    private const OFFICE_EXTENSIONS = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp'];
    private const VIDEO_EXTENSIONS = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'];
    private const AUDIO_EXTENSIONS = ['mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a'];
    private const TEXT_EXTENSIONS = ['txt', 'csv', 'json', 'xml', 'html', 'htm', 'md', 'log', 'yaml', 'yml'];

    public function generate(): string
    {
        /** @var CredentialSubmission $submission */
        $submission = $this->getSubject();
        $credential = $submission->getCredentialRecord();

        if (!$credential) {
            return $this->renderNoFile();
        }

        $file = $credential->getFile();

        if (!$file instanceof Media) {
            return $this->renderNoFile();
        }

        $extension = strtolower($file->getExtension());
        $url = $file->getFullUrl();
        $name = $file->getName();

        if (in_array($extension, self::IMAGE_EXTENSIONS, true)) {
            return $this->renderImage($url, $name);
        }

        if (in_array($extension, self::PDF_EXTENSIONS, true)) {
            return $this->renderPdf($url);
        }

        if (in_array($extension, self::OFFICE_EXTENSIONS, true)) {
            return $this->renderOffice($url);
        }

        if (in_array($extension, self::VIDEO_EXTENSIONS, true)) {
            return $this->renderVideo($url, $extension);
        }

        if (in_array($extension, self::AUDIO_EXTENSIONS, true)) {
            return $this->renderAudio($url, $extension);
        }

        if (in_array($extension, self::TEXT_EXTENSIONS, true)) {
            return $this->renderText($file, $url, $name);
        }

        return $this->renderDownloadLink($url, $name);
    }

    private function renderNoFile(): string
    {
        return '<p class="text-muted">No file submitted.</p>';
    }

    private function renderImage(string $url, string $name): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);
        $escapedName = htmlspecialchars($name, ENT_QUOTES);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--image">
    <img src="{$escapedUrl}" alt="{$escapedName}" class="img-fluid" style="max-width:100%;height:auto;" />
</div>
HTML;
    }

    private function renderPdf(string $url): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--pdf" style="width:100%;height:80vh;">
    <embed src="{$escapedUrl}" type="application/pdf" width="100%" height="100%" />
    <p class="mt-2">
        <a href="{$escapedUrl}" target="_blank" class="btn btn-sm btn-outline-secondary">
            Open in new tab
        </a>
    </p>
</div>
HTML;
    }

    private function renderOffice(string $url): string
    {
        $viewerUrl = htmlspecialchars(
            'https://docs.google.com/gview?embedded=true&url=' . rawurlencode($url),
            ENT_QUOTES
        );
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--office" style="width:100%;height:80vh;">
    <iframe src="{$viewerUrl}"
            style="border:none;width:100%;height:100%;"
            allowfullscreen
            sandbox="allow-scripts allow-popups"></iframe>
    <p class="mt-2">
        <a href="{$escapedUrl}" target="_blank" class="btn btn-sm btn-outline-secondary">
            Download file
        </a>
    </p>
</div>
HTML;
    }

    private function renderVideo(string $url, string $extension): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);
        $mime = $this->videoMime($extension);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--video">
    <video controls style="max-width:100%;width:100%;">
        <source src="{$escapedUrl}" type="{$mime}" />
        Your browser does not support the video tag.
        <a href="{$escapedUrl}" target="_blank">Download video</a>
    </video>
</div>
HTML;
    }

    private function renderAudio(string $url, string $extension): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);
        $mime = $this->audioMime($extension);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--audio">
    <audio controls style="width:100%;">
        <source src="{$escapedUrl}" type="{$mime}" />
        Your browser does not support the audio element.
        <a href="{$escapedUrl}" target="_blank">Download audio</a>
    </audio>
</div>
HTML;
    }

    private function renderText(Media $file, string $url, string $name): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);
        $escapedName = htmlspecialchars($name, ENT_QUOTES);

        try {
            $content = $file->read();
            $escapedContent = htmlspecialchars((string) $content, ENT_QUOTES);
            return <<<HTML
<div class="credential-file-preview credential-file-preview--text">
    <pre class="border rounded p-3" style="max-height:60vh;overflow:auto;white-space:pre-wrap;word-break:break-word;">{$escapedContent}</pre>
    <p class="mt-2">
        <a href="{$escapedUrl}" download="{$escapedName}" class="btn btn-sm btn-outline-secondary">
            Download file
        </a>
    </p>
</div>
HTML;
        } catch (\Throwable $e) {
            return $this->renderDownloadLink($url, $name);
        }
    }

    private function renderDownloadLink(string $url, string $name): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES);
        $escapedName = htmlspecialchars($name, ENT_QUOTES);

        return <<<HTML
<div class="credential-file-preview credential-file-preview--download">
    <p class="text-muted mb-2">Preview not available for this file type.</p>
    <a href="{$escapedUrl}" target="_blank" download="{$escapedName}" class="btn btn-outline-primary">
        Download {$escapedName}
    </a>
</div>
HTML;
    }

    private function videoMime(string $extension): string
    {
        return match($extension) {
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogg' => 'video/ogg',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'mkv' => 'video/x-matroska',
            default => 'video/' . $extension,
        };
    }

    private function audioMime(string $extension): string
    {
        return match($extension) {
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'ogg' => 'audio/ogg',
            'aac' => 'audio/aac',
            'flac' => 'audio/flac',
            'm4a' => 'audio/mp4',
            default => 'audio/' . $extension,
        };
    }
}

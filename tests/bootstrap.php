<?php

use Marktic\Credentials\Tests\Fixtures\Models\CredentialRequirements\CredentialRequirements;
use Marktic\Credentials\Tests\Fixtures\Models\CredentialSubmissions\CredentialSubmissions;
use Marktic\Credentials\Tests\Fixtures\Models\CredentialTypes\CredentialTypes;
use Marktic\Credentials\Tests\Fixtures\Models\Credentials\Credentials;
use Nip\Container\Container;

require dirname(__DIR__) . '/vendor/autoload.php';

Container::setInstance(new Container());

$container = Container::getInstance();

$container->set('credential_types', new CredentialTypes());
$container->set('credential_credentials', new Credentials());
$container->set('credential_requirements', new CredentialRequirements());
$container->set('credential_submissions', new CredentialSubmissions());

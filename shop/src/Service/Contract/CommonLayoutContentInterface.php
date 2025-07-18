<?php

// src/Service/Contract/CommonLayoutContentInterface.php
namespace App\Service\Contract;

interface CommonLayoutContentInterface
{
    public function getKey(): string; // Например: 'header', 'footer'
    public function render(): string; // HTML контент компонента
}

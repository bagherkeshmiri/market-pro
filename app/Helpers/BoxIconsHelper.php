<?php

function timerIcon(): string
{
    return '<i class="bx bx-timer text-white"></i>';
}

function linkIcon(): string
{
    return '<i class="bx bx-link  text-white"></i>';
}

function userIcon(string $toolTipTitle = ''): string
{
    return '<i id="bx-show" class="bx bx-show" data-toggle="tooltip" data-placement="top" title="' . $toolTipTitle . '"></i>';
}

function emailIcon(): string
{
    return '<i class="bx bx-mail-send  text-white"></i>';
}

function arrowIcon(): string
{
    return '<i id="icon-arrow" class="bx bx-left-arrow-alt  text-white"></i>';
}

function lockIcon(): string
{
    return '<i class="bx bxs-lock text-white"></i>';
}

function mobileIcon(): string
{
    return '<i class="bx bx-mobile text-white"></i>';
}

function saveIcon(): string
{
    return '<i id="icon-arrow text-white" class="bx bx-save"></i>';
}

function titleIcon(): string
{
    return '<i id="bx-text" class="bx bx-text text-white"></i>';
}

function warningPencilIcon(): string
{
    return '<i class="bx bx-pencil bx-sm bx-tada-hover" style="color:#FDAC41 !important; font-size: 19px !important;"></i>';
}

function dangerTrashIcon(): string
{
    return '<i class="bx bx-trash bx-sm bx-tada-hover" style="color:#FF5B5C !important; font-size: 19px !important;"></i>';
}

function dangerXIcon(): string
{
    return '<i class="bx bx-x bx-sm bx-tada-hover" style="color:#FF5B5C !important;"></i>';
}

function successCheckIcon(): string
{
    return '<i class="bx bx-check bx-sm bx-tada-hover" style="color:#39DA8A  !important;"></i>';
}

function copyIcon(): string
{
    return '<i class="bx bx-copy bx-sm bx-tada-hover"></i>';
}

function dollarIcon(): string
{
    return '<i class="bx bx-dollar text-white"></i>';
}

function packageIcon(): string
{
    return '<i class="bx bx-package text-white"></i>';
}

function starIcon(bool $isWhite = false): string
{
    if ($isWhite) {
        return '<i class="bx bx-star text-white"></i>';
    } else {
        return '<i class="bx bx-star"></i>';
    }
}

function plusIcon(): string
{
    return '<i id="bx-plus" class="bx bx-plus text-white"></i>';
}

function minusIcon(): string
{
    return '<i id="bx-minus" class="bx bx-minus text-white"></i>';
}

function showIcon(string $toolTipTitle = ''): string
{
    return '<i id="bx-show" class="bx bx-show" data-toggle="tooltip" data-placement="top" title="' . $toolTipTitle . '"></i>';
}

function listIcon(string $toolTipTitle = ''): string
{
    return '<i id="bx-list-ul" class="bx bx-list-ul" data-toggle="tooltip" data-placement="top" title="' . $toolTipTitle . '"></i>';
}

function locationIcon(string $toolTipTitle = ''): string
{
    return '<i id="bx-map" class="bx bx-map" data-toggle="tooltip" data-placement="top" title="' . $toolTipTitle . '"></i>';
}

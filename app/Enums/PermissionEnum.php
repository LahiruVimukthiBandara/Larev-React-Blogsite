<?php

namespace App\Enums;

enum PermissionEnum: string {
    case SiteControl = 'SiteControl';
    case ReadArticle = 'ReadArticle';
    case WriteArticle = 'WriteArticle';
}

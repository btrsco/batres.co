<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservedUsername implements ValidationRule
{
    /**
     * List of all reserved usernames.
     *
     * @var array|string[]
     */
    private array $usernames = [
        // A
        'about', 'abuse', 'account', 'accounts', 'add', 'adm', 'ads', 'advertising',
        'affiliate', 'affiliates', 'analytics', 'api', 'app', 'apps', 'appserver',
        'archive', 'assets', 'auth', 'authentication', 'avatar',

        // B
        'beta', 'billing', 'blog', 'blogs', 'business',

        // C
        'categories', 'category', 'comment', 'comments', 'contact', 'controlpanel', 'cp', 'cpanel',
        'creator', 'creators', 'css', 'customer', 'customers', 'customize',

        // D
        'dashboard', 'designer', 'dev', 'developer', 'discover', 'download', 'downloads',
        'documentation', 'docs', 'domain', 'domains', 'donate', 'donation', 'donations', 'draft',
        'drafts',

        // E
        'edit', 'editor', 'email', 'enterprise', 'entry', 'entries', 'error', 'errors', 'event',

        // F
        'faq', 'feed', 'file', 'files', 'follow', 'forum', 'forums', 'free', 'ftp',

        // G
        'goto', 'group', 'groups', 'guest', 'guests', 'guidelines', 'guideline',

        // H
        'help', 'helpdesk', 'home', 'homepage', 'host', 'hosting', 'hostmaster', 'hostname', 'html',
        'http', 'https',

        // I
        'image', 'images', 'info', 'invite',

        // J
        'job', 'jobs', 'js', 'json', 'jsontest',

        // K
        'knowledgebase', 'kudos', 'knowledge-base', 'knowledge_base', 'knowledgebase', 'kb',

        // L
        'library', 'like', 'likes', 'link', 'links', 'login', 'logout',

        // M
        'manager', 'me', 'media', 'message', 'messages', 'messenger', 'mod', 'moderator',

        // N
        'name', 'news', 'newsletter', 'nickname', 'null', 'nova',

        // O
        'onboarding', 'order', 'orders', 'owner',

        // P
        'page', 'pages', 'posts', 'preferences', 'privacy', 'privacypolicy',
        'privacy_policy', 'privacy-policy', 'profile',

        // Q
        'question', 'questions',

        // R
        'register', 'registration', 'remove', 'report', 'reports', 'root',
        'rss', 'rules',

        // S
        'search', 'settings', 'signin', 'signout', 'signup', 'sign-in', 'sign-out', 'sign-up',
        'sitemap', 'staff', 'submit', 'submitted',

        // T
        'test', 'terms', 'terms-of-service', 'terms_of_service', 'termsofservice',
        'tos', 'tour', 'tours', 'tutorial', 'tutorials',

        // U
        'upload', 'user', 'username', 'users',

        // V
        'video', 'videos', 'visitor',

        // W
        'webmaster', 'widget', 'widgets', 'wiki', 'www', 'www1', 'www2', 'www3', 'www4', 'www5',
        'www6', 'www7', 'www8', 'www9',

        // X
        'xml',

        // Y
        'you',

        // Z
    ];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array( trim( strtolower( $value ) ), $this->usernames )) {
            $fail(__('This :attribute has been reserved.'));
        }
    }
}

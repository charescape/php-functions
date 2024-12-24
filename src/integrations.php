<?php

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Mention\MentionExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;

if (!function_exists('pf_gfm')) {
    function pf_gfm(): MarkdownConverter
    {
        // https://commonmark.thephpleague.com/2.6/extensions/github-flavored-markdown/
        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        return new MarkdownConverter($environment);
    }
}

if (!function_exists('pf_gfm_ff_default_config')) {
    function pf_gfm_ff_default_config(): array
    {
        return [
            // https://commonmark.thephpleague.com/2.6/extensions/table-of-contents/
            'table_of_contents' => [
                'html_class' => 'gfm-table-of-contents',
                'normalize' => 'relative',
                'style' => 'bullet',
                'min_heading_level' => 1,
                'max_heading_level' => 4,

                'position' => 'top',
                'placeholder' => null,
            ],
            // https://commonmark.thephpleague.com/2.6/extensions/external-links/
            'external_link' => [
                'internal_hosts' => ['www.example.com'], // Don't forget to set this!
                'open_in_new_window' => true,
                'html_class' => 'gfm-external-link',
                'nofollow' => '',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
            // https://commonmark.thephpleague.com/2.6/extensions/mentions/
            'mentions' => [

            ],
            'heading_permalink' => [
                'html_class' => 'gfm-heading-permalink',
                'heading_class' => 'gfm-heading',

                // this should typically be set to the same value
                'id_prefix' => 'gfm-',
                'fragment_prefix' => 'gfm-',

                'apply_id_to_heading' => true,
                'insert' => 'before',
                'min_heading_level' => 1,
                'max_heading_level' => 4,
                'title' => '',
                'symbol' => '🔗',
                'aria_hidden' => true,
            ],
        ];
    }
}

if (!function_exists('pf_gfm_ff')) {
    function pf_gfm_ff(array $config = []): MarkdownConverter
    {
        if (pf_is_array_empty($config)) {
            $config = pf_gfm_ff_default_config();
        }

        // https://commonmark.thephpleague.com/2.6/extensions/github-flavored-markdown/
        $environment = new Environment($config);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        // https://commonmark.thephpleague.com/2.6/extensions/attributes/
        $environment->addExtension(new AttributesExtension());

        // https://commonmark.thephpleague.com/2.6/extensions/external-links/
        $environment->addExtension(new ExternalLinkExtension());

        // https://commonmark.thephpleague.com/2.6/extensions/table-of-contents/
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new TableOfContentsExtension());

        // https://commonmark.thephpleague.com/2.6/extensions/front-matter/
        $environment->addExtension(new FrontMatterExtension());

        // https://commonmark.thephpleague.com/2.6/extensions/mentions/
        $environment->addExtension(new MentionExtension());

        return new MarkdownConverter($environment);
    }
}

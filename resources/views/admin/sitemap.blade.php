<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
    <url>
        <loc>{{route('post-details',['slug'=>$post->slug])}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($post->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
    @foreach ($blogs as $blog)
    <url>
        <loc>{{route('blog-details',['slug'=>$blog->slug])}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($blog->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
    <url>
        <loc>{{route('privacyPolicy')}}</loc>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{route('termsCondition')}}</loc>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
</urlset>
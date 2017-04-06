UPDATE wp_options SET option_value = replace(option_value, 'http://www.example.com', 'http://localhost/test-site') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = replace(post_content, 'http://www.example.com', 'http://localhost/test-site');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.example.com','http://localhost/test-site');

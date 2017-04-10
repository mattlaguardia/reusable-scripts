UPDATE wp_options SET option_value = replace(option_value, 'http://acclivityassociates.com/', 'http://localhost/clients/template_a/') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = replace(post_content, 'http://acclivityassociates.com/', 'http://localhost/clients/template_a/');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://acclivityassociates.com/','http://localhost/clients/template_a/');

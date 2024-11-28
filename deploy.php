<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';
require 'contrib/npm.php';

set('application', 'IBP-inv');
set('keep_releases', 2);
set('repository', 'https://github.com/lucaciotti/ibp-inv.git');
set('git_tty', true);
set('php_fpm_version', '8.2');

set('use_relative_symlink', false);
set('ssh_multiplexing', false);

host('dev')
    ->set('stage', 'dev')
    ->set('remote_user', 'root')
    ->set('hostname', 'inv.ibpoms.lucaciotti.space')
    ->set('shared_files', ['.env', 'auth.json'])
    ->set('deploy_path', '/var/www/ibpinv.lucaciotti.space');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'npm:install',
    'npm:run:prod',
    'deploy:publish',
    // 'php-fpm:reload',
    // 'supervisor:reload:dbSeed',
    // 'supervisor:reload:email',
    // 'supervisor:reload:dataMining',
    // 'setPermission:bootstrap',
    // 'setPermission:storage',
    'apache:restart'
]);

task('npm:run:prod', function () {
    cd('{{release_path}}');
    run('npm run build');
});

task('apache:restart', function () {
    // if (get('stage') == 'prod') {
        run('/usr/sbin/service apache2 restart');
    // }
});

after('deploy:failed', 'deploy:unlock');

<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';
require 'contrib/npm.php';

set('application', 'pNet');
set('keep_releases', 2);
set('repository', 'https://github.com/lucaciotti/ibp-inv.git');
set('git_tty', true);
set('php_fpm_version', '8.0');

set('use_relative_symlink', false);
set('ssh_multiplexing', false);

host('dev')
    ->set('stage', 'dev')
    ->set('remote_user', 'root')
    ->set('hostname', 'ibpoms.lucaciotti.space')
    ->set('identity_file', '~/.ssh/id_ed25519_old')
    ->set('shared_files', ['.env', 'auth.json'])
    ->set('deploy_path', '/var/www/ibp-inv.lucaciotti.space');

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
    'php-fpm:reload',
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

task('migrate:pNet', function () {
    cd('{{release_path}}');
    run('php artisan migrate --database=pNet_DATA --path=./database/migrations/pNet_DB --force');
});

task('supervisor:reload:dbSeed', function () {
    if (get('stage') == 'prod') {
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S supervisorctl restart pnet-worker-dbSeed:*');
    } else {
        // run('sudo supervisorctl restart pnet-worker-dbSeed:*');
    }
});

task('supervisor:reload:email', function () {
    if (get('stage') == 'prod') run('echo "RJ6SMfkPZa9qBcoN" | sudo -S supervisorctl restart pnet-worker-email:*');
});

task('supervisor:reload:dataMining', function () {
    if (get('stage') == 'prod') {
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S supervisorctl restart pnet-worker-dataMining:*');
    } else {
        // run('sudo supervisorctl restart pnet-worker-dataMining:*');
    }
});

task('setPermission:storage', function () {
    if (get('stage') == 'prod') {
        cd('{{release_path}}');
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S chown -R $USER:www-data storage');
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S chmod -R 777 storage');
    }
});

task('setPermission:bootstrap', function () {
    if (get('stage') == 'prod') {
        cd('{{release_path}}');
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S chown -R $USER:www-data bootstrap/cache');
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S chmod -R 777 bootstrap/cache');
    }
});

task('apache:restart', function () {
    if (get('stage') == 'prod') {
        run('echo "RJ6SMfkPZa9qBcoN" | sudo -S /usr/sbin/service apache2 restart');
    } else {
        // run('sudo /usr/sbin/service apache2 restart');
    }
});

after('deploy:failed', 'deploy:unlock');

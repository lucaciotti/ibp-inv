<aside class="control-sidebar control-sidebar-{{ config('adminlte.right_sidebar_theme') }}">
    @yield('right-sidebar')
    <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 10px; height: 100%; width: 100%;">
    
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs" id="controlTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="settingTab" data-toggle="pill" href="#setting" role="tab"
                        aria-controls="setting" aria-selected="false"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Admin
                        Settings</a>
                </li>
            </ul>
    
            <div class="tab-content" id="controlTabContent">
    
                <div class="tab-pane fade active show" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                    <a href='{{ url('users') }}'>
                        <button type="submit" class="btn btn-block btn-outline-light">
                            <i class="fas fa-user-friends"></i>&nbsp;&nbsp;Gestione Utenti
                        </button>
                    </a>
    
                    <hr class="mb-2 bg-white">
                    <a href='{{ url('log-viewer') }}'>
                        <button type="submit" class="btn btn-block btn-outline-warning">
                            <i class="fas fa-solar-panel"></i>&nbsp;&nbsp;Admin Log Panel
                        </button>
                    </a>
    
                    <hr class="mb-2 bg-white">
                </div>
            </div>
        </div>
    </div>
</aside>

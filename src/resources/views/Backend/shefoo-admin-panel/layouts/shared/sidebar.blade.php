<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">




        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="#">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">3</span>
                </a>

                <ul class="menu-content">
                    <li><a class="menu-item" href="dashboard-ecommerce.html" data-i18n="nav.dash.ecommerce">Example 1</a></li>
                </ul>

            </li>





            @foreach(config('shefoo-admin-panel-sidebar.admin') as $label => $links)
                <li class=" navigation-header">
                    <span>{{$label}}</span>
                    <i class="la la-ellipsis-h ft-minus"></i>
                </li>

                @foreach($links as $index => $details)
                    <li class="nav-item {{request()->is($details['prefix'].'/*') ? 'active' : ''}}" >
                        <a href="{{route($details['route'])}}"><i class="{{$details['icon']}}"></i>
                            <span class="menu-title">{{__('shefoo-admin-panel.'.$details['name'])}}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>


<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @foreach ($admin_menu as $menuItem)
                @if (
                    (isset($menuItem['is_active']) && $menuItem['is_active']) ||
                        (isset($menuItem['children']) && count($menuItem['children']) > 0))
                    @if (!isset($menuItem['permission']) || (isset($menuItem['permission']) && checkAccess($menuItem['permission'])))
                        @if (isset($menuItem['children']) && count($menuItem['children']) > 0)
                            <li
                                class="treeview {{ checkIsMenuActive($menuItem['children']) ? 'menu-open active' : '' }}">
                                <a href="#">
                                    <i class="{{ $menuItem['icon'] ?? 'fa fa-dashboard' }}"></i>
                                    <span>{{ $menuItem['title'] ?? 'Menu' }}</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>

                                <ul class="treeview-menu"
                                    style="display:{{ checkIsMenuActive($menuItem['route_name']) ? 'block' : '' }}">
                                    @foreach ($menuItem['children'] as $child)
                                        @if (checkAccess($child['permission']))
                                            <li class="{{ checkIsMenuActive($child['route_name']) ? 'active' : '' }}">
                                                <a href="{{ route($child['route_name']) }}">
                                                    <i class="{{ $child['icon'] ?? 'fa fa-university' }}"></i>
                                                    <span>{{ $child['title'] ?? 'Child Menu' }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="{{ checkIsMenuActive($menuItem['route_name']) ? 'active' : '' }}">
                                <a href="{{ route($menuItem['route_name']) }}">
                                    <i class="{{ $menuItem['icon'] ?? 'fa fa-group' }}"></i>
                                    <span>{{ $menuItem['title'] ?? '' }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endif
            @endforeach
        </ul>
    </section>
</aside>

 <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                   
                   
                    <li class="active">
                        <a href="{{route('admin.dashboard')}}" onClick="return false;" class="menu-toggle">
                            <i data-feather="monitor"></i>
                            <span>Dashboard</span>
                        </a>
                       
                    </li>
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle">
                            <i data-feather="users"></i>
                            <span>Sites</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('tenantsmangerside.index')}}">All Sites</a>
                            </li>
                            <li>
                                <a href="{{route('tenants.create')}}">Add Site</a>
                            </li>
                            
                        </ul>
                    </li>
                  
                  
                    
                           
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
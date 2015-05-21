            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ URL::to('/backend') }}"><i class="fa fa-fw fa-dashboard"></i> 系统统计</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/colleges') }}"><i class="fa fa-fw fa-edit"></i>学校管理</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/carticles') }}"><i class="fa fa-fw fa-edit"></i>学校资讯管理</a>
                    </li>
                     <li>
                        <a href="{{ URL::to('/backend/specialties ') }}"><i class="fa fa-fw fa-table"></i>专业管理</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/mschools') }}"><i class="fa fa-fw fa-bar-chart-o"></i>用户学校管理</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/ktests') }}"><i class="fa fa-fw fa-table"></i>K测试管理</a>
                    </li>
                     <li>
                        <a href="{{ URL::to('/admin/users/dashboard') }}"><i class="fa fa-fw fa-table"></i>用户管理</a>
                    </li>
              
                </ul>
            </div>
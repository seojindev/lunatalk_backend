                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:;">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">LunaTak <sup>2</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;"><i class="fas fa-fw fa-tachometer-alt"></i><span>대시보드</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    쇼핑몰 관리
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item" active>
                    <a class="nav-link collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i><span>제품관리</span>
                    </a>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">제품:</h6>
                            <a class="collapse-item" href="javascript:;" name="goPageURL" pageUrl="/front/admin/v1/products/list">목록</a>
                            <a class="collapse-item" href="javascript:;" name="goPageURL" pageUrl="/front/admin/v1/products/create">등록</a>
                            <h6 class="collapse-header">구입:</h6>
                            <a class="collapse-item" href="javascript:;">목록</a>
                            <h6 class="collapse-header">결제:</h6>
                            <a class="collapse-item" href="javascript:;">목록</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    고객센터
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i><span>고객센터</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">문의:</h6>
                            <a class="collapse-item" href="javascript:;">문의</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i><span>문의</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">일반회원:</h6>
                            <a class="collapse-item" href="javascript:;">목록</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    관리
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="javascript:;" data-toggle="collapse" data-target="#serviceUtilities" aria-expanded="true" aria-controls="serviceUtilities">
                        <i class="fas fa-fw fa-wrench"></i><span>관리</span>
                    </a>
                    <div id="serviceUtilities" class="collapse" aria-labelledby="servicePages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">서비스 공지사항:</h6>
                            <a class="collapse-item" href="javascript:;" name="goPageURL" pageUrl="/front/admin/v1/service/service-notice">등록</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

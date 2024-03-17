<style>
  #navbarDropdownMenuLink:hover, #btn_tacking:hover, #btn_warranty:hover,#btn_recomment:hover, #btn_about:hover{
   color:#021b39;
  }
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light" id="navIndex">
  <div class="container-lg">
    <a class="navbar-brand" href="index.php"><i class="bi bi-house-door-fill" id="btn_index">&nbsp;</i>หน้าแรก</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-pc-display"></i>&nbsp;สินค้าทั้งหมด</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">โน๊ตบุ๊ค</a>
              <ul class="submenu dropdown-menu">
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=apple">Apple</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=microsoft">Microsoft</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=asus">Asus</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=acer">Acer</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=lenovo">Lenovo</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=msi">MSI</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=xiaomi">XIAOMI</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=dell">DELL</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=lg">LG</a></li>
                <li><a class="dropdown-item" href="search.php?search1=โน๊ตบุ๊ค&&search2=hp">HP</a></li>
              </ul>
            </li>
            <li><a class="dropdown-item" href="#">คอมพิวเตอร์ตั้งโต๊ะ</a>
              <ul class="submenu dropdown-menu">
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=apple">Apple</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=asus">Asus</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=acer">Acer</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=lenovo">Lenovo</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=msi">MSI</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=dell">DELL</a></li>
                <li><a class="dropdown-item" href="search.php?search1=คอมพิวเตอร์ตั้งโต๊ะ&&search2=hp">HP</a></li>
              </ul>
            </li>
            <li><a class="dropdown-item" href="#">จอมอนิเตอร์</a>
              <ul class="submenu dropdown-menu">
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=ASUS">Asus</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=acer">Acer</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=lenovo">Lenovo</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=msi">MSI</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=xiaomi">XIAOMI</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=dell">Dell</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=lg">LG</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=samsung">Samsung</a></li>
                <li><a class="dropdown-item" href="search.php?search1=จอมอนิเตอร์&&search2=viewsonic">ViewSonic</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="track.php" id="btn_tacking"><i class="bi bi-truck"></i>&nbsp;ตรวจสอบคำสั่งซื้อ&nbsp;&nbsp;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="warranty.php" id="btn_warranty"><i class="bi bi-box-seam"></i>&nbsp;การรับประกันสินค้า&nbsp;&nbsp;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recommend.php" style="text-overflow: ellipsis;"><i class="bi bi-chat-square-dots"></i>&nbsp;แนะนำการบริการ&nbsp;&nbsp;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php" id="btn_about"><i class="bi bi-info-circle"></i>&nbsp;เกี่ยวกับเรา</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
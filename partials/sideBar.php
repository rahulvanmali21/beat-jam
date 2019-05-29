<div id="sideBarContainer">
            <nav class="navBar">
                <span   tabindex="0" role="link" onclick="openPage('index.php')"  class="logo"><img src="./assets/images/logo.png"  alt=""></span>

                <div class="Elements">
                    <div class="navItem">
                    <span   tabindex="0" role="link" onclick="openPage('search.php')" class="navLink">Search <img src="./assets/images/icons/search.png" alt=""> </a>
                    </div>
                </div>

                <div class="Elements">
                    <div class="navItem">
                    <span   tabindex="0" role="link" onclick="openPage('index.php')" class="navLink">BROWSE</span>
                    </div>
                    
                    <div class="navItem">
                    <span   tabindex="0" role="link" onclick="openPage('myMusic.php')" class="navLink">My Music </span>
                    </div>

                    <div class="navItem">
                    <span   tabindex="0" role="link" onclick="openPage('setting.php')" class="navLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
                    </div>
                </div>
            </nav>
        </div>
   <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span>
                            </button>
                        </div>
    
 <!-- Main Navigation -->
                        <nav id="navigation" class="style-1">
                            <ul id="responsive">
                                <li><a class="current" href="{{URL::to('/')}}">Home</a></li>
								<li><a class="active" href="">Venue</a></li>
								<li><a class="" href="#">Space</a></li>
								<li><a class="" href="#">Services</a></li>
								<li><a class="" href="#">Happenings</a>
									<ul class="sub-drop-main">
										<li><a href="#">Events Ticket</a></li>
										<li><a href="#">Activity Ticket</a></li>
									</ul>
								</li>
								<li><a class="" href="#">Digital</a>
									<ul class="sub-drop-main">
										<li class="menu-item-has-children"><a href="#">Interactive Content</a> 
											<ul class="sub-drop-sub">
												<li><a href="#">3D VR Walkthrough Gallery</a></li>
												<li><a href="#">Get 3D VR Pricing &amp; Plan</a></li>
												<li><a href="#">360 Aerial Panoramic Gallery</a></li>
												<li><a href="#">Get 360 Aerial Pricing &amp; Plan</a></li>
											</ul>
										</li>
										<li><a href="#">Digital Marketing</a></li>
									</ul>
								</li> 
                              <li> 
            <select name="countrylist" id="countrylist" class="countrylist">    
            <?php foreach($countries as $country){?>
            <option value="<?php echo $country->countryId; ?>" <?php if($country->countryId==Session::get('countryid')){?> selected="selected" <?php } ?>> <?php echo ucwords($country->name); ?> </option>
            <?php } ?>  
            </select>
        </li>
                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Left Side Content / End -->

                    <!-- Right Side Content / End -->
                    <div class="right-side">
                        <div class="header-widget">
                            <a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button sign-in"><i class="icon-line-awesome-user"></i> <span>Signin / Signup</span></a> 
                             </div>
                    </div>
                    <!-- Right Side Content / End -->
    <div class="header">
        <div class="logo">
            <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="<?php echo Yii::app()->user->avatar; ?>" alt="" />
                        <div class="userinfo">
                        <?php if(!Yii::app()->user->isGuest){?>
                            <h5><?php echo Yii::app()->user->nick; ?></h5>
                            <ul>
                                <li><a href="#">有效期到：<?php echo Yii::app()->user->expiredDate?></a></li>
                                <li><a href="#">还剩<?php echo floor((strtotime(Yii::app()->user->expiredDateTime)-time ())/(3600*24))+1?>天到期</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/logout">退出系统</a></li>
                            </ul>
                        <?php }else{?>
							<a href="<?php echo Yii::app()->params['oauthAuthorizeUrl']?>">login first</a>
						<?php }?>
                        </div>

                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>

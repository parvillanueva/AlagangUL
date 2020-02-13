   
<div class="container-fluid">
    <div class="au-container au-exfilter au-padding">
        <div class="row">        
            <div class="col-lg-3 col-md-4">
                <div class="au-userpicture d-none d-lg-block">
                    <?php if(empty($profile->imagepath)) : ?>
                        <img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-useravatar">
                    <?php else: ?>
                        <img src="<?=base_url() . $profile->imagepath ?>" class="au-useravatar">
                    <?php endif; ?>
                </div>

                <div id='calendar'></div>

            </div>

            <div class="col-lg-9 col-md-8">
                <span class="au-h4">Points Level</span>
                <div class="au-pointslevel">
                    <div class="au-ptscol">
                        <span class="au-pts">0</span>
                        <span class="au-level"><span>0</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">10</span>
                        <span class="au-level"><span>1</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">20</span>
                        <span class="au-level"><span>2</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">30</span>
                        <span class="au-level"><span>3</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">40</span>
                        <span class="au-level"><span>4</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">50</span>
                        <span class="au-level"><span>5</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">60</span>
                        <span class="au-level"><span>6</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">70</span>
                        <span class="au-level"><span>7</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">80</span>
                        <span class="au-level"><span>8</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">90</span>
                        <span class="au-level"><span>9</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">100</span>
                        <span class="au-level"><span>10</span></span>
                    </div>
                    <div class="au-prbar">
                        <div class="au-levelbar" id="progress1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">								
                        <div class="au-boxed au-achivements">
                            <div class="au-titlebox">Achivements
                                <div class="au-inner">
                                    <div class="au-p2">
                                        <span>Points Earned</span>
                                        <span class="au-pfaccpoints"><div class="au-heart"><i class="fas fa-heart"></i></div><?=$profile->current_points?></span>
                                    </div>
                                    <div class="au-p2">
                                        <?php if(!empty($badges)) : ?>
                                            <span>Badges</span>
                                                <div class="au-badges">
                                                    <?php foreach($badges as $badge) : ?>
                                                        <div class="au-badge">
                                                            <i class="au-icon <?=@$badge['icon']?>" title="<?=@$badge['title']?>" style="color:<?=@$badge['color']?>"></i>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <!-- <div class="au-badge"><i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i></div>
                                                    <div class="au-badge"><i class="fas fa-gem au-treasure au-icon" title="Treasure"></i></div> -->
                                                </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="au-p2">
                                                <span>Joined Programs</span>
                                                <span class="au-pfnum"><?= @$c_programs ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="au-p2">
                                                <span>Volunteered Events</span>
                                                <span class="au-pfnum"><?= @$c_events ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="au-jprogramswrapper">
                            <span class="au-title">Programs Created</span>
                            <div class="slider programs">
                                <?php if(!empty($created)) : ?>
                                    <?php foreach($created as $program) : ?>
                                        <div class="au-slprograms">
                                            <a href="programs/<?= @$program['id']?>/<?= @$program['url_alias']?>" class="au-lnk">
                                                <div class="au-opthumbnail">
                                                    <img src="<?=base_url().@$program['image_thumbnail']?>" class="au-fp-thumbnailimg">
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <hr>
                            <span class="au-title">Programs Joined</span>
                            <div class="slider programs">
                                <?php if(!empty($programs)) : ?>
                                    <?php foreach($programs as $program) : ?>
                                        <div class="au-slprograms">
                                            <a href="<?=@$program['url_alias']?>" class="au-lnk">
                                                <div class="au-opthumbnail">
                                                    <img src="<?=base_url().@$program['image_thumbnail']?>"class="au-fp-thumbnailimg">
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="au-boxed">
                    <div class="au-titlebox">Activities Volunteered</div>
                    <div class="au-content au-padding">
                        <div class="au-eventswrapper au-volunteeredwrapper">
                            <?php if(!empty($events)) : ?>
                                <?php foreach($events as $event) : ?>
                                    <div class="au-event-entry" id="activity<?=@$event['id']?>">
                                        <div class="au-event">
                                            <div class="row">
                                                <div class="col-sm-3 au-eventthumbnail">
                                                    <img src="<?=base_url(). @$event['image_thumbnail']?>" class="au-eventimg">
                                                </div>
                                                <div class="col-sm-9 au-eventdetails">
                                                    <div class="au-program">
                                                        <a href="programs/<?= $event['id'] ."/" .$event['url_alias']?>" class="au-lnk">
                                                            <div class="au-pthumbnail">
                                                                <img src="<?=base_url(). @$event['image_thumbnail']?>" class="au-fp-thumbnailimg">
                                                            </div>
                                                            <span class="au-ptitle"><?= @$event['title']?></span>
                                                            <span class="au-pdetails">
                                                                <div class="au-programdetails">
                                                                    <div class="au-inner">
                                                                        <span class="au-pans"><span class="au-pques">When:</span><?=@date_format(date_create($event['when']),"F d, Y  h:i A")?></span>
                                                                    </div>
                                                                    <div class="au-inner">
                                                                        <span class="au-pans"><span class="au-pques">Where:</span><?= @$event['where']?></span>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="au-volunteers">
                                                        <span class="au-volunteeredmes">
                                                        <?php if(!empty($event['badges'])) : ?>
                                                            
                                                            <?php foreach($event['badges'] as $badges) : ?>
                                                                <span>
                                                                
                                                                    <i 
                                                                        class="<?=$badges[1]; ?>" 
                                                                        style="color:<?=$badges[2]?>" 
                                                                        title="<?=$badges[0]?>">
                                                                    </i>Volunteered <?=$badges[0]?>
                                                                </span>
                                                        
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        
                                                        <!-- <span class="au-volunteeredmes"><i class="fas fa-hands-helping au-talent" title="Talent"></i>Volunteered Talent</span> -->
                                                        <!-- <span class="au-volunteeredmes"><i class="fas fa-gem au-treasure" title="Treasure"></i>Volunteered Treasure</span> -->
                                                        <!-- <span class="au-volunteeredmes"><i class="fas fa-hourglass au-time" title="Time"></i><i class="fas fa-hands-helping au-talent" title="Talent"></i>Volunteered Time & Talent</span> -->
                                                        <!-- <span class="au-volunteeredmes"><i class="fas fa-gem au-treasure" title="Treasure"></i><i class="fas fa-hourglass au-time" title="Time"></i>Volunteered Treasure & Time</span> -->
                                                        <!-- <span class="au-volunteeredmes"><i class="fas fa-hands-helping au-talent" title="Talent"></i><i class="fas fa-gem au-treasure" title="Treasure"></i>Volunteered Talent & Treasure</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>				
    </div>
</div>
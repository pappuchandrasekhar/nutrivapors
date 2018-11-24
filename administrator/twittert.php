 <?php
                    $tweets = @simplexml_load_file('https://twitter.com/statuses/user_timeline/vjnoriega.rss');
					//print_r($tweets);
                    for($t = 0; $t < 2; $t++)
                    {
					
                    ?>
                    
               <?php /*?> <blockquote class="twitter-tweet"><p>Search API will now always return "real" Twitter user IDs. The with_twitter_user_id parameter is no longer necessary. An era has ended. ^TS</p>&mdash; Twitter API (@twitterapi) <a href="<?php echo $tweets->channel->item[$t]->link; ?>" data-datetime="2011-11-07T20:21:07+00:00">November7, 2011</a></blockquote><script src="//platform.twitter.com/widgets.js" charset="utf-8"></script><?php */?>
                
                   <a class="twitter-timeline" href="<?php echo $tweets->channel->item[$t]->link; ?>" data-widget-id="<?php echo $tweets->channel->item[$t]->guid; ?>">Tweets by @twitterapi</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					
                     <br />
                    <?php 
					}
                    ?>
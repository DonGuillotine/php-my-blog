<!-- blog sidebar -->
<div class="col-md-4">
    <div class="box-widget-wrap fl-wrap fixed-bar">
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Search In Blog</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <div class="search-widget">
                        <form action="search.php" method="post" class="fl-wrap">
                            <input name="search" type="text" class="search" placeholder="Search.." />
                            <button class="search-submit color2-bg" name="submit" type="submit"><i class="fal fa-search"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Popular Posts</h3>
            </div>
            <div class="box-widget  fl-wrap">
                <div class="box-widget-content">
                    <!--widget-posts-->
                    <div class="widget-posts  fl-wrap">
                        <ul class="no-list-style">
                            <li>
                                <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/1.png" alt=""></a></div>
                                <div class="widget-posts-descr">
                                    <h4><a href="listing-single.html">Nullam dictum felis</a></h4>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 27 Mar 2019</a></div>
                                </div>
                            </li>
                            <li>
                                <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/2.png" alt=""></a></div>
                                <div class="widget-posts-descr">
                                    <h4><a href="listing-single.html">Scrambled it to mak</a></h4>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 12 May 2018</a></div>
                                </div>
                            </li>
                            <li>
                                <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/3.png" alt=""></a> </div>
                                <div class="widget-posts-descr">
                                    <h4><a href="listing-single.html">Fermentum nis type</a></h4>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i>22 Feb  2018</a></div>
                                </div>
                            </li>
                            <li>
                                <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/4.png" alt=""></a> </div>
                                <div class="widget-posts-descr">
                                    <h4><a href="listing-single.html">Rutrum elementum</a></h4>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 7 Mar 2017</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- widget-posts end-->
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap">
            <div class="banner-wdget fl-wrap">
                <div class="overlay"></div>
                <div class="bg" style="background-image: url(images/bg/13.jpg)"></div>
                <div class="banner-wdget-content fl-wrap">
                    <h4>Whant to be notified about new post and news ? Subscribe For a Newsletter.</h4>
                    <a href="#subscribe" class="custom-scroll-link color-bg" > Sign up</a>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Tags</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <div class="list-single-tags tags-stylwrap">
                        <a href="#">Hotel</a>
                        <a href="#">Hostel</a>
                        <a href="#">Room</a>
                        <a href="#">Spa</a>
                        <a href="#">Restourant</a>
                        <a href="#">Parking</a>
                    </div>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Categories</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <ul class="cat-item no-list-style">
                        <?php
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection, $query);
                        if(!$result){
                            die("CONNECTION FAILED" . mysqli_error($connection));
                        }

                        while ($row = mysqli_fetch_assoc($result)){
                            $cat_id = $row['cat_id'];
                            $contain = $row['cat_title'];
                            echo "<li><a href='categories.php?category=$cat_id'>{$contain}</a><span>$cat_id</span></li>";
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
    </div>
</div>
<!-- blog sidebar end -->
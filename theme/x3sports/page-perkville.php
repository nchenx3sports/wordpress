<?php
/*
Template Name: Perkville
*/
get_header(); ?>

		<section role="main" class="schedule signup">
			<div class="two-column">
				<h1>Member Resources: Perkville</h1>
				<article class="loading">
					<div class="post">

						<?php if (have_posts()): while (have_posts()) : the_post(); the_content(); edit_post_link('[Edit]', '<p>', '</p>'); endwhile; endif; ?>

					</div><!--post-->
X3′s Member Rewards Program powered by:

perkville_small_logo

Earn rewards with everything you are already doing with X3′s Perville Rewards Program. Learn how to get started!

For a full list of what you can redeem for and how to earn points, download our guide: X3 Sports Points Reward Program.

Q: How do I start earning member points?

A: 1.Go to www.perkville.com and click Join (or Join with Facebook)
2. Enter your email address, the same one on file as X3 Sports 
3. Create a password 
4. You will receive an email to confirm their registration. 
5. Boom! Now you can start earning points to redeem X3 merchandise


<h3>X3′s Member Rewards Program powered by:</h3>
<p>
<a href="../wp-content/uploads/2015/02/perkville_small_logo.png”>
<img class="aligncenter size-full wp-image-4294" src="http://x3sports.com/wordpress/wp-content/uploads/2015/02/perkville_small_logo.png" alt="perkville_small_logo" width="123" height="34" /></a></p>

<p>Earn rewards with everything you are already doing with X3′s Perville Rewards Program. Learn how to get started!</p>

<p>For a full list of what you can redeem for and how to earn points, download our guide: <a href="http://x3sports.com/wordpress/wp-content/uploads/2015/04/X3-Sports-Points-Reward-Program-Perkville-2.18.2015.pdf">X3 Sports Points Reward Program.</a></p>

<p><strong>Q: How do I start earning member points?</strong></p><p><strong>A: </strong>

1.Go to <a href="http://www.perkville.com">www.perkville.com</a> and click Join (<em>or</em> Join with Facebook)<br />

2. Enter your email address, the same one on file as X3 Sports <br />

3. Create a password <br />

4. You will receive an email to confirm their registration. <br />

5. Boom! Now you can start earning points to redeem X3 merchandise</p>

				</article>
			</div><!--two-column-->
		</section>

<?php get_footer(); ?>

<?php $my_posts = new WP_Query;
// $myposts = $my_posts->query( [
// 	'post_type' => 'projects',
// 	'posts_per_page' => -1,
// ] );
// foreach( $myposts as $pst ){
// 	echo '<br>_____________<br>';
// 	$img1 = carbon_get_post_meta($pst->ID,'ru_img1');
// 	$img2 = carbon_get_post_meta($pst->ID,'ru_img2');
// 	echo $img1;
// 	$arr = array(
// 		'ID'		=> $pst->ID , 
// 		'meta_input' => [
// 			'_r_img1' =>$img1,
// 			'_r_img2' =>$img2,
// 		],
// 	);

// // 	$arr['meta_input']['r_img1'] = $img1;
// // 	$arr['meta_input']['r_img2'] = $img2;
	
// 	wp_update_post( 
// 		wp_slash($arr) 
// 	);
	
// };
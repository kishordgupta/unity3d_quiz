<?
$qrylistsel_rec="
			SELECT d.*,
			3956 * 2 * ASIN(SQRT(POWER(SIN(($lat-abs(d.curr_lat)) * pi()/180 / 2),
			2) + COS($lat * pi()/180 ) * COS(abs(d.curr_lat) * pi()/180) * POWER(SIN(($long - d.curr_lng) * pi()/180 / 2), 2) )) as distance
			FROM 
				device_token d			
			WHERE
				d.cat_id IN (1)
			GROUP BY
				d.id			
			HAVING 
				distance <= $dist	
			ORDER BY 
				distance ASC
			LIMIT $off,$limit";
?>            
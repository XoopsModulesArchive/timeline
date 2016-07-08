<?php
// $Id: monet.php,v 1.1 2011/12/26 05:46:36 ohwada Exp $

//=========================================================
// timeline module
// 2011-12-25 K.OHWADA
//=========================================================

//---------------------------------------------------------
// original
// http://www.simile-widgets.org/timeline/examples/monet/monet.html
//---------------------------------------------------------
function timelime_sample_monet()
{
	$arr = array();

	$arr[] = array( 
		'start' => "Nov 14 1840 00:00:00 GMT",
		'start_month' => "11",
		'start_day'   => "14",
		'start_year'  => "1840",
		'start_tz'    => "GMT",

		'title' => "Birth",
		'image' => "sample/monet.png",
		'link' => "http://en.wikipedia.org/wiki/Monet",
		'description' => "Claude Monet, also known as Oscar-Claude Monet or Claude Oscar Monet was born to Adolphe and Louise-Justine Monet of 45 Rue Laffitte, in the 9th arrondissement of Paris. &lt;p&gt; He was christened as Oscar-Claude at the church of Notre-Dame-de-Lorette. His father wanted him to go into the family (grocery store) business, but Claude Monet wanted to become an artist. His mother was a singer, both parents were second-generation Parisians. &lt;/p&gt;",
	); 

	$arr[] = array( 
		'start'       => "1845",
		'start_year'  => "1845",
		'start_tz'    => "GMT",
		'end'         => "1846",
		'end_year'    => "1846",
		'end_tz'      => "GMT",

		'title' => "Family moved to Le Havre, Normandy",
	); 

	$arr[] = array( 
		'start' => "Apr 01 1851 00:00:00 GMT",
		'start_month' => "4",
		'start_day'   => "01",
		'start_year'  => "1851",
		'start_tz'    => "GMT",

		'title' => "Entered Le Havre secondary school",
		'description' => "On the first of April 1851 Monet entered the Le Havre secondary school. He first became known locally for his charcoal caricatures, which he would sell for ten to twenty francs. Monet also undertook his first drawing lessons from Jean-Francois Ochard, a former student of Jacques-Louis David (1748 - 1825). On the beaches of Normandy, he met fellow artist Eugene Boudin, who became his mentor and taught him to use oil paints. Boudin taught Monet en plein air (outdoor) techniques for painting.",
	); 

	$arr[] = array( 
		'start' => "Jan 28 1857 00:00:00 GMT",
		'start_month' => "1",
		'start_day'   => "28",
		'start_year'  => "1857",
		'start_tz'    => "GMT",

		'title' => "Mother died",
		'description' => "On 28 January, 1857 his mother died. Now 16 years old, he left school and his widowed, childless aunt Marie-Jeanne took him into her home.Mother died",
	); 

	$arr[] = array( 
		'start' => "Jun 01 1861 00:00:00 GMT",
		'start_month' => "6",
		'start_day'   => "01",
		'start_year'  => "1861",
		'start_tz'    => "GMT",

		'latest_start' => "Jul 01 1861 00:00:00 GMT",
		'latest_start_month' => "7",
		'latest_start_day'   => "01",
		'latest_start_year'  => "1861",
		'latest_start_tz'    => "GMT",

		'earliest_end' => "Jun 01 1863 00:00:00 GMT",
		'earliest_end_month' => "6",
		'earliest_end_day'   => "01",
		'earliest_end_year'  => "1863",
		'earliest_end_tz'    => "GMT",

		'end' => "Jul 01 1863 00:00:00 GMT",
		'end_month' => "7",
		'end_day'   => "01",
		'end_year'  => "1863",
		'end_tz'    => "GMT",

		'is_duration' => "true",
		'title' => "Joined Cavalry in Algeria",
		'description' => "In June of 1861 Monet joined the First Regiment of African Light Cavalry in Algeria for two years of a seven-year commitment, but upon his contracting typhoid his aunt Madame Lecadre intervened to get him out of the army if he agreed to complete an art course at a university. It is also possible that the Dutch painter Johan Barthold Jongkind (whom Monet knew) may have prompted his aunt on this matter.",
	); 

	$arr[] = array( 
		'start'       => "1862",
		'start_year'  => "1862",
		'start_tz'    => "GMT",
		'end'         => "1863",
		'end_year'    => "1863",
		'end_tz'      => "GMT",

		'title' => "Joined studio of Charles Gleyre in Paris",
		'description' => "Disillusioned with the traditional art taught at universities, instead in 1862 he joined the studio of Charles Gleyre in Paris, where he met Pierre-Auguste Renoir, Frederic Bazille, and Alfred Sisley. Together they shared new approaches to art, which later came to be known as impressionism, featuring open spaces and light painted with thick brushstrokes.",
	); 

	$arr[] = array( 
		'start'       => "1866",
		'start_year'  => "1866",
		'start_tz'    => "GMT",
		'end'         => "1867",
		'end_year'    => "1867",
		'end_tz'      => "GMT",

		'title' => "Camille",
		'icon' => "images/icons/green-circle.png",
		'description' => "Monet's 1866 Camille or The Woman in the Green Dress (La Femme a la Robe Verte), which brought him recognition, depicted Camille Doncieux. Shortly thereafter Doncieux became pregnant and bore their first child, Jean. ",
	); 

	$arr[] = array( 
		'start'       => "1868",
		'start_year'  => "1868",
		'start_tz'    => "GMT",
		'end'         => "1869",
		'end_year'    => "1869",
		'end_tz'      => "GMT",

		'title' => "Attempted suicide",
		'description' => "In 1868, Monet attempted suicide but failed to do so.",
	); 

	$arr[] = array( 
		'start'       => "1870",
		'start_year'  => "1870",
		'start_tz'    => "GMT",
		'end'         => "1871",
		'end_year'    => "1871",
		'end_tz'      => "GMT",

		'title' => "Took refuge in England",
		'description' => "During the Franco-Prussian War (1870?1871), Monet took refuge in England to avoid the conflict. There he studied the works of John Constable and J. M. W. Turner.",
	); 

	$arr[] = array( 
		'start'             => "1871",
		'start_year'        => "1871",
		'start_tz'          => "GMT",
		'latest_start'      => "1872",
		'latest_start_year' => "1872",
		'latest_start_tz'   => "GMT",
		'earliest_end'      => "1878",
		'earliest_end_year' => "1878",
		'earliest_end_tz'   => "GMT",
		'end'               => "1879",
		'end_year'          => "1879",
		'end_tz'            => "GMT",

		'is_duration' => "true",
		'title' => "Lived at Argenteuil, near Paris",
		'description' => "From 1871 to 1878 Monet lived at Argenteuil, a village on the Seine near Paris, and here were painted some of his best known works. ",
	); 

	$arr[] = array( 
		'start'       => "1872",
		'start_year'  => "1872",
		'start_tz'    => "GMT",
		'end'         => "1873",
		'end_year'    => "1873",
		'ends_tz'     => "GMT",

		'title' => "Impression, Sunrise",
		'image' => "sample/impression-sunrise.png",
		'icon' => "images/icons/green-circle.png",
		'link' => "http://en.wikipedia.org/wiki/Image:Claude_Monet%2C_Impression%2C_soleil_levant%2C_1872.jpg",
		'description' => "Upon returning to France, in 1872 (or 1873) he painted Impression, Sunrise (Impression, soleil levant) depicting a Le Havre landscape. It hung in the first impressionist exhibition in 1874 and is now displayed in the Musee Marmottan-Monet, Paris. From the painting's title, art critic Louis Leroy coined the term 'impressionism', which he intended to be derogatory.",
	); 

	$arr[] = array( 
		'start'       => "1870",
		'start_year'  => "1870",
		'start_tz'    => "GMT",
		'end'         => "1871",
		'end_year'    => "1871",
		'end_tz'      => "GMT",

		'title' => "Married Doncieux",
		'description' => "In 1870, Monet and Doncieux married and in 1873 moved into a house in Argenteuil near the Seine River.",
	); 

	$arr[] = array( 
		'start'       => "1873",
		'start_year'  => "1873",
		'start_tz'    => "GMT",
		'end'         => "1874",
		'end_year'    => "1874",
		'ends_tz'     => "GMT",

		'title' => "Monet's Garden at Argenteuil",
		'icon' => "images/icons/green-circle.png",
		'image' => "http://www.accents-n-art.com/artwork/M00279ss.jpg",
		'link' => "http://www.accents-n-art.com/artists/claude_monet/monets-garden-at-argenteuil.html",
		'description' => "Some of Claude Monet's best known work was done in Argenteuil, including one of his famous garden scenes Monet's Garden at Argenteuil which he painted in 1873.",
	); 

	$arr[] = array( 
		'start'       => "1875",
		'start_year'  => "1875",
		'start_tz'    => "GMT",
		'end'         => "1879",
		'end_year'    => "1879",
		'end_tz'      => "GMT",

		'title' => "The Seine at Argenteuil",
		'icon' => "images/icons/green-circle.png",
		'image' => "http://www.accents-n-art.com/artwork/M00506ss.jpg",
		'link' => "http://www.accents-n-art.com/artists/claude_monet/the-seine-at-argenteuil.html",
		'description' => "He worked almost exclusively in Argenteuil from 1875 to 1878. The Seine at Argenteuil was one of his famous paintings during this period. The painting was recently featured in the hit movie Vanilla Sky, starring Tom Cruise and Cameron Diaz.",
	); 

	$arr[] = array( 
		'start' => "Mar 18 1878 00:00:00 GMT",
		'start_month' => "3",
		'start_day'   => "18",
		'start_year'  => "1878",
		'start_tz'    => "GMT",

		'title' => "Second son Michel born",
		'description' => "Monet and Doncieux had another son, Michel, on March 17, 1878.",
	); 

	$arr[] = array( 
		'start'       => "1879",
		'start_year'  => "1879",
		'start_tz'    => "GMT",
		'end'         => "1880",
		'end_year'    => "1880",
		'end_tz'      => "GMT",

		'title' => "Doncieux died",
		'description' => "Madame Monet died of tuberculosis in 1879.",
	); 

	$arr[] = array( 
		'start' => "Apr 01 1883 00:00:00 GMT",
		'start_month' => "4",
		'start_day'   => "01",
		'start_year'  => "1883",
		'start_tz'    => "GMT",

		'end' => "May 01 1883 00:00:00 GMT",
		'end_month' => "5",
		'end_day'   => "01",
		'end_year'  => "1883",
		'end_tz'    => "GMT",

		'title' => "Moved to Giverny with Alice Hoschede",
		'description' => "Alice Hoschede decided to help Monet by bringing up his two children together with her own. They lived in Poissy, which Monet hated.  In April 1883 they moved to a house in Giverny, Eure, in Haute-Normandie, where he planted a large garden which he painted for the rest of his life.",
	); 

	$arr[] = array( 
		'start'       => "1892",
		'start_year'  => "1892",
		'start_tz'    => "GMT",
		'end'         => "1893",
		'end_year'    => "1893",
		'end_tz'      => "GMT",

		'title' => "Married Hoschede",
		'description' => "Monet and Hoschede married in 1892.",
	); 

	$arr[] = array( 
		'start'             => "1880",
		'start_year'        => "1880",
		'start_tz'          => "GMT",
		'latest_start'      => "1885",
		'latest_start_year' => "1885",
		'latest_start_tz'   => "GMT",
		'earliest_end'      => "1895",
		'earliest_end_year' => "1895",
		'earliest_end_tz'   => "GMT",
		'end'               => "1900",
		'end_year'          => "1900",
		'end_tz'            => "GMT",

		'is_duration' => "true",
		'title' => "'Series' painting",
		'description' => "In the 1880s and 1890s, Monet began 'series' painting: paintings of one subject in varying light and viewpoints. His first series is of Rouen Cathedral from different points of view and at different times of the day.",
	); 

	$arr[] = array( 
		'start'       => "1895",
		'start_year'  => "1895",
		'start_tz'    => "GMT",
		'end'         => "1896",
		'end_year'    => "1896",
		'end_tz'      => "GMT",

		'title' => "Durand-Ruel gallery",
		'description' => "Twenty views of Monet's Rouen cathedral were exhibited at the Durand-Ruel gallery in 1895.",
	); 

	$arr[] = array( 
		'start'       => "1889",
		'start_year'  => "1889",
		'start_tz'    => "GMT",
		'end'         => "1890",
		'end_year'    => "1890",
		'end_tz'      => "GMT",

		'title' => "Water Lily Pond",
		'icon' => "images/icons/green-circle.png",
		'image' => "sample/water-lily-pond.png",
		'link' => "http://en.wikipedia.org/wiki/Image:Monet.waterlilies.500pix.jpg",
		'description' => "Monet was exceptionally fond of painting controlled nature: his own garden in Giverny, with its water lilies, pond and bridge. He also painted up and down the banks of the Seine.",
	); 

	$arr[] = array( 
		'start'       => "1883",
		'start_year'  => "1883",
		'start_tz'    => "GMT",
		'end'         => "1909",
		'end_year'    => "1909",
		'end_tz'      => "GMT",

		'is_duration' => "true",
		'title' => "Painted landscapes and seascapes",
		'color' => "#0a0",
		'image' => "http://www.accents-n-art.com/artwork/M00358ss.jpg",
		'link' => "http://www.accents-n-art.com/artists/claude_monet/san-giorgio-maggiore-at-dusk.html",
		'description' => "Claude Monet made several trips to the Mediterranean between 1883 and 1908. During these visits he painted many landscapes and seascapes such as Bordighera. Famous landmarks were also a favorite subject for Monet in the Mediterranean. His paintings in Venice included the Grand Canal, Doges' Palace, and San Giorgio Maggiore. The Monet painting that was stolen in the movie The Thomas Crown Affair was San Giorgio Maggiore at Dusk.",
	); 

	$arr[] = array( 
		'start'       => "1883",
		'start_year'  => "1883",
		'start_tz'    => "GMT",
		'end'         => "1884",
		'end_year'    => "1884",
		'end_tz'      => "GMT",

		'title' => "The Artist's Garden in Giverny",
		'icon' => "images/icons/green-circle.png",
		'image' => "http://www.accents-n-art.com/artwork/M00006ss.jpg",
		'link' => "http://www.accents-n-art.com/artists/claude_monet/monets-garden-the-irises.html",
		'description' => "Monet moved to Giverny, France in 1883. Shortly after his arrival in Giverny, Claude began developing the famous garden that was the inspiration for many of his most famous paintings. The Artist's Garden in Giverny is one of the most popular paintings. His garden in Giverny grew to include a water garden and a japanese style bridge. Water lilies and the Japanese bridge were the subject of many Monet paintings.",
	); 

	$arr[] = array( 
		'start'       => "1911",
		'start_year'  => "1911",
		'start_tz'    => "GMT",
		'end'         => "1912",
		'end_year'    => "1912",
		'end_tz'      => "GMT",

		'title' => "Second wife died",
	); 

	$arr[] = array( 
		'start'       => "1914",
		'start_year'  => "1914",
		'start_tz'    => "GMT",
		'end'         => "1915",
		'end_year'    => "1915",
		'end_tz'      => "GMT",

		'title' => "Son Jean died",
	); 

	$arr[] = array( 
		'start'       => "1923",
		'start_year'  => "1923",
		'start_tz'    => "GMT",
		'end'         => "1924",
		'end_year'    => "1924",
		'end_tz'      => "GMT",

		'title' => "Underwent 2 cataract surgeries",
		'description' => "Cataracts formed on his eyes for which he underwent two surgeries in 1923. It is interesting to note that the paintings done while the cataracts affected his vision have a general reddish tone, which is a characteristic of the vision of cataract victims. It may also be that after his surgery, he was now able to see certain ultraviolet wavelengths of light that are normally excluded by the lens of the eye; this may have had an effect on the colors he perceived. After his operations he even repainted some of these paintings. ",
	); 

	$arr[] = array( 
		'start' => "Dec 5 1926 00:00:00 GMT",
		'start_month' => "11",
		'start_day'   => "5",
		'start_year'  => "1926",
		'start_tz'    => "GMT",

		'title' => "Death",
		'description' => "Monet died December 5, 1926 at the age of 86 and is buried in the Giverny church cemetery. His famous home and garden with its waterlily pond and bridge at Giverny are a popular drawcard for tourists. In the house there are many examples of Japanese woodcut prints on the walls.",
	); 

	return $arr;
}

?>
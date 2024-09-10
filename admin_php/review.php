<?php
// Define options for fetching reviews
$options = array(
    'google_maps_review_cid' => '11860600279898202731', // Replace with your actual Google CID
    'show_only_if_with_text' => false,                 // true = show only reviews with text
    'show_only_if_greater_x' => 0,                     // Only show reviews with more than X stars
    'show_rule_after_review' => true,                  // Show <hr> after each review
    'show_blank_star_till_5' => true,                  // Always show 5 stars e.g. ⭐⭐⭐☆☆
    'your_language_for_tran' => 'en',                  // Language for auto-translate reviews
    'sort_by_reating_best_1' => true,                  // Sort by rating (best first)
    'show_cname_as_headline' => true,                  // Show customer name as headline
    'show_age_of_the_review' => true,                  // Show the age of each review
    'show_txt_of_the_review' => true,                  // Show the text of each review
    'show_author_of_reviews' => true,                  // Show the author of each review
);

// Display the reviews automatically when the page is opened
echo getReviews($options);

/**
 * Function to fetch and display Google reviews
 */
function getReviews($option)
{
    $ch = curl_init('https://www.google.com/maps?cid=' . $option['google_maps_review_cid']);                                                               /* GOOGLE REVIEWS BY cURL */
    if (isset($option['your_language_for_tran']) and !empty($option['your_language_for_tran'])) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: ' . $option['your_language_for_tran']));
    }
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);                                                                                                                                     /* </cURL END> */
    $pattern = '/window\.APP_INITIALIZATION_STATE(.*);window\.APP_FLAGS=/ms';                                                                            /* REVIEW REGEX PATTERN */
    if (preg_match($pattern, $result, $match)) {                                                                                                       /* CHECK IF REVIEWS FOUND */
        $match[1] = trim($match[1], ' =;');                                                                                                                /* DIRTY JSON FIX */
        $reviews = json_decode($match[1]);                                                                                                                /* 2. JSON DECODE */
        $reviews = ltrim($reviews[3][6], ")]}'");                                                                                                         /* DIRTY JSON FIX */
        $reviews = json_decode($reviews);                                                                                                                 /* 2. JSON DECODE */
        $customer = $reviews[6][175][9];                                                                                                                     /* POSITION OF REVIEWS */
        $reviews = $reviews[6][175][9][0][0]; // NEW IN 2024                                                                                                                 /* POSITION OF REVIEWS */
    }                                                                                                                                                    /* END CHECK */
    $return = '';                                                                                                                                        /* INI VAR */
    if (isset($reviews)) {                                                                                                                               /* CHECK REVIEWS */
        if (isset($option['sort_by_reating_best_1']) and $option['your_lansort_by_reating_best_1guage_for_tran'] == true)                                /* CHECK SORT */
            array_multisort(array_map(function ($element) {
                return $element[4];
            }, $reviews), SORT_DESC, $reviews);                                           /* SORT */
        $return .= '<div class="quote">';                                                                                                                  /* OPEN DIV */
        if (isset($option['show_cname_as_headline']) and $option['show_cname_as_headline'] == true)
            $return .= '<strong>' . $customer . '</strong><br>';       /* CUSTOMER */
        if (isset($option['show_rule_after_review']) and $option['show_rule_after_review'] == true)
            $return .= '<hr size="1">';                            /* RULER */
        foreach ($reviews as $review) {
            $comment_name = $review[0][1][4][5][0]; // NEW IN 2024
            $review_text = $review[0][2][15][0][0]; // NEW IN 2024
            $comment_rating = $review[0][2][0][0]; // NEW IN 2024                                                                                                  /* START LOOP */
            if (isset($option['show_only_if_with_text']) and $option['show_only_if_with_text'] == true and empty($review_text))
                continue;                      /* CHECK TEXT */
            if (isset($option['show_only_if_greater_x']) and $comment_rating <= $option['show_only_if_greater_x'])
                continue;                                      /* CHECK RATING */
            for ($i = 1; $i <= $comment_rating; ++$i)
                $return .= '⭐';                                                                                              /* RATING */
            if (isset($option['show_blank_star_till_5']) and $option['show_blank_star_till_5'] == true)
                for ($i = 1; $i <= 5 - $comment_rating; ++$i)
                    $return .= '☆'; /* RATING */
            $return .= '<br>';                                                                                                                               /* NEWLINE */
            if (isset($option['show_txt_of_the_review']) and $option['show_txt_of_the_review'] == true)
                $return .= $review_text . '<br>';                        /* TEXT */
            if (isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true)
                $return .= '<small>' . $comment_name . ' </small>';      /* AUTHOR */
            if (
                isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true and                                                   /* IF AUTHOR & AGE */
                isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true
            )
                $return .= '<small> &mdash; </small>';      /* AGE */
            if (isset($option['show_rule_after_review']) and $option['show_rule_after_review'] == true)
                $return .= '<hr size="1">';                          /* RULER */
        }                                                                                                                                                  /* END LOOP */
        $return .= '</div>';                                                                                                                               /* CLOSE DIV */
    }                                                                                                                                                    /* CHECK REVIEWS */
    return $return;                                                                                                                                      /* RETURN DATA */
}
?>
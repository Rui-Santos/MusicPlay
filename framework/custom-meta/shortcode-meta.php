<?php
// S H O R T C O D E S   M E T A
//--------------------------------------------------------
global $atp_ribbons, $iva_anim,$staff_social;
$atp_shortcodes = array(
    
    //Columns
    //--------------------------------------------------------
    'Columns' => array(
        'name' => __('Columns', 'ATP_ADMIN_SITE'),
        'value' => 'Layouts',
        'subtype' => true,
        'options' => array(
            // LAYOUT (1/2 - 1/2)
            //--------------------------------------------------------
            array(
                'name' => __('Two Column Layout', 'ATP_ADMIN_SITE'),
                'value' => 'one_half_layout',
                'options' => array(
                    array(
                        'name' => __('One Half', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'layout_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Half Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'layout_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/3 -1/3)
            //--------------------------------------------------------
            array(
                'name' => __('Three Column Layout', 'ATP_ADMIN_SITE'),
                'value' => 'one_third_layout',
                'options' => array(
                    array(
                        'name' => __('One Third', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'one_third_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Third', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one_third_2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Third Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'one_third_3',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/4 -1/4 - 1/4 - 1/4)
            //--------------------------------------------------------
            array(
                'name' => __('Four Column Layout', 'ATP_ADMIN_SITE'),
                'value' => 'one_fourth_layout',
                'options' => array(
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'one_fourth_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one_fourth_2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'one_fourth_3',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your fourth Column',
                        'id' => 'one_fourth_4',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/5 - 1/5 - 1/5 - 1/5 - 1/5 - 1/5)
            //--------------------------------------------------------
            array(
                'name' => __('Five Column Layout', 'ATP_ADMIN_SITE'),
                'value' => 'one5thlayout',
                'options' => array(
                    array(
                        'name' => __('One Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'one5thlayout1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one5thlayout2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'one5thlayout3',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your fourth Column',
                        'id' => 'one5thlayout4',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fifth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your fifth Column',
                        'id' => 'one5thlayout5',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6)
            //--------------------------------------------------------
            array(
                'name' => __('Six Column Layout', 'ATP_ADMIN_SITE'),
                'value' => 'one6thlayout',
                'options' => array(
                    array(
                        'name' => __('One Sixth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'one6thlayout1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Sixth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one6thlayout2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Sixth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'one6thlayout3',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Sixth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your fourth Column',
                        'id' => 'one6thlayout4',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Sixth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your fifth Column',
                        'id' => 'one6thlayout5',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Sixth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your sixth Column',
                        'id' => 'one6thlayout6',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/3 -2/3)
            //--------------------------------------------------------
            array(
                'name' => __('One Third - Two Third', 'ATP_ADMIN_SITE'),
                'value' => 'one_3rd_2rd',
                'options' => array(
                    array(
                        'name' => __('One Third', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'one3rd2rd_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Two Third Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one3rd2rd_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (2/3 -1/3)
            //--------------------------------------------------------
            array(
                'name' => __('Two Third - One Third', 'ATP_ADMIN_SITE'),
                'value' => 'two_3rd_1rd',
                'options' => array(
                    array(
                        'name' => __('Two Third', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'two3rd1rd_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Third Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'one3rd2rd_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/4 -3/4)
            //--------------------------------------------------------
            array(
                'name' => __('One Fourth - Three Fourth', 'ATP_ADMIN_SITE'),
                'value' => 'One_4th_Three_4th',
                'options' => array(
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'One4thThree4th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Three Fourth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'One4thThree4th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (3/4 -1/4)
            //--------------------------------------------------------
            array(
                'name' => __('Three Fourth - One Fourth', 'ATP_ADMIN_SITE'),
                'value' => 'Three_4th_One_4th',
                'options' => array(
                    array(
                        'name' => __('Three Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'Three4thOne4th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'Three4thOne4th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/4 - 1/4 - 1/2)
            //--------------------------------------------------------
            array(
                'name' => __('One Fourth - One Fourth - One Half', 'ATP_ADMIN_SITE'),
                'value' => 'One_4th_One_4th_One_half',
                'options' => array(
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'One4thOne4thOnehalf_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'One4thOne4thOnehalf_2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Half Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'One4thOne4thOnehalf_3',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/2 - 1/4 - 1/4)
            //--------------------------------------------------------
            array(
                'name' => __('One Half - One Fourth - One Fourth', 'ATP_ADMIN_SITE'),
                'value' => 'One_half_One_4th_One_4th',
                'options' => array(
                    array(
                        'name' => __('One Half', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'OnehalfOne4thOne4th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'OnehalfOne4thOne4th_2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'OnehalfOne4thOne4th_3',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/4 - 1/2 - 1/4)
            //--------------------------------------------------------
            array(
                'name' => __('One Fourth - One Half - One Fourth', 'ATP_ADMIN_SITE'),
                'value' => 'One_4th_One_half_One_4th',
                'options' => array(
                    array(
                        'name' => __('One Fourth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'One4thOnehalfOne4th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Half', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'One4thOnehalfOne4th_2',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fourth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your third Column',
                        'id' => 'One4thOnehalfOne4th_3',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (1/5 - 4/5)
            //--------------------------------------------------------
            array(
                'name' => __('One Fifth - Four Fifth', 'ATP_ADMIN_SITE'),
                'value' => 'One_5th_Four_5th',
                'options' => array(
                    array(
                        'name' => __('One Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'One5thFour5th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Four Fifth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'One5thFour5th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (4/5 - 1/5)
            //--------------------------------------------------------
            array(
                'name' => __('Four Fifth - One Fifth', 'ATP_ADMIN_SITE'),
                'value' => 'Four_5th_One_5th',
                'options' => array(
                    array(
                        'name' => __('Four Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'Four5thOne5th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('One Fifth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'Four5thOne5th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (2/5 - 3/5)
            //--------------------------------------------------------
            array(
                'name' => __('Two Fifth - Three Fifth', 'ATP_ADMIN_SITE'),
                'value' => 'Two_5th_Three_5th',
                'options' => array(
                    array(
                        'name' => __('Two Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'Two5thThree5th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Three Fifth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'Two5thThree5th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            ),
            // LAYOUT (3/5 -2/5)
            //--------------------------------------------------------
            array(
                'name' => __('Three Fifth - Two Fifth', 'ATP_ADMIN_SITE'),
                'value' => 'Three_5th_Two_5th',
                'options' => array(
                    array(
                        'name' => __('Three Fifth', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your first Column',
                        'id' => 'Three5thTwo5th_1',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Two Fifth Last', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter Content for your second Column',
                        'id' => 'Three5thTwo5th_2',
                        'std' => '',
                        'type' => 'textarea'
                    )
                )
            )
        )
    ),
    
    // B L O C K Q U O T E 
    //--------------------------------------------------------
    'Block Quotes' => array(
        'name' => __('Block Quotes', 'ATP_ADMIN_SITE'),
        'value' => 'blockquote',
        'options' => array(
            array(
                'name' => __('Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display as a blockquote.',
                'id' => 'content',
                'std' => '',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for your blockquote.',
                'info' => '(optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Cite', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the name of the author which displays at the end of the blockquote.',
                'info' => '(optional)',
                'id' => 'cite',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Cite Link', 'ATP_ADMIN_SITE'),
                'desc' => 'The link displays after the Citation.',
                'info' => '(optional)',
                'id' => 'citelink',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the width in % or px, if you wish to use the blockquote in a specific width.',
                'info' => '(optional)',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )			
        )
    ),


	// C U S T O M  A N I M A T I O N 
    //--------------------------------------------------------
    'Custom Animation' => array(
        'name' => __('Custom Animation', 'ATP_ADMIN_SITE'),
        'value' => 'custom_animation',
        'options' => array(
            array(
                'name' => __('Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Add your content which you want to animate',
                'id' => 'content',
                'std' => '',
                'type' => 'textarea'
            ),     
                    
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )	
        )
    ),

    
    // D R O P C A P  1 
    //--------------------------------------------------------
    'Drop Cap 1' => array(
        'name' => __('Drop Cap 1', 'ATP_ADMIN_SITE'),
        'value' => 'dropcap1',
        'options' => array(
            array(
                'name' => __('Dropcap Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the letter you want to display as Dropcap',
                'id' => 'dropcap_text',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Dropcap Colors', 'ATP_ADMIN_SITE'),
                'desc' => 'Use Predefined Color for the Dropcap Background',
                'info' => '(Optional)',
                'id' => 'color',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'greensea' => 'Green Sea',
                    'nephritis' => 'Nephritis',
                    'belizehole' => 'Belize Hole',
                    'wisteria' => 'Wisteria',
                    'midnightblue' => 'Midnight Blue',
                    'orange' => 'Orange',
                    'pumpkin' => 'Pumpkin',
                    'pomegranate' => 'Pomegranate',
                    'silver' => 'Silver',
                    'abestos' => 'Abestos',
                    'black' => 'Black',
                    'white' => 'White'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )	
        )
    ),
    
    // D R O P C A P   2 
    //--------------------------------------------------------
    'Drop Cap 2' => array(
        'name' => __('Drop Cap 2', 'ATP_ADMIN_SITE'),
        'value' => 'dropcap2',
        'options' => array(
            array(
                'name' => __('Dropcap Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the letter you want to display as Dropcap',
                'id' => 'dropcap_text',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Dropcap Background Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Use Colorpicker to choose your desired color for the Dropcap Background',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )	
        )
    ),
    
    // D R O P C A P   3 
    //--------------------------------------------------------
    'Drop Cap 3' => array(
        'name' => __('Drop Cap 3', 'ATP_ADMIN_SITE'),
        'value' => 'dropcap3',
        'options' => array(
            array(
                'name' => __('Dropcap Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the letter you want to display as Dropcap',
                'id' => 'dropcap_text',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Dropcap Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Use Colorpicker to choose your desired color for the Dropcap Text',
                'info' => '(optional)',
                'id' => 'color',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )	
        )
    ),
    
    // G O O G L E   F O N T
    //--------------------------------------------------------
    'Google Font' => array(
        'name' => __('Google Font', 'ATP_ADMIN_SITE'),
        'value' => 'googlefont',
        'options' => array(
            array(
                'name' => __('Google Font Name', 'ATP_ADMIN_SITE'),
                'desc' => __('Type the font you want to display.', 'ATP_ADMIN_SITE'),
                'id' => 'font',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Google Font Size', 'ATP_ADMIN_SITE'),
                'desc' => __('Type the font size in px.', 'ATP_ADMIN_SITE'),
                'id' => 'size',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Google Font Style', 'ATP_ADMIN_SITE'),
                'desc' => __('Type the font style ex:400italic.', 'ATP_ADMIN_SITE'),
                'id' => 'size',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Font Margin', 'ATP_ADMIN_SITE'),
                'desc' => __('Type the font margin in px.', 'ATP_ADMIN_SITE'),
                'id' => 'margin',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Content Here', 'ATP_ADMIN_SITE'),
                'desc' => __('Type the text you wish to display .', 'ATP_ADMIN_SITE'),
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )
        )
    ),
    // H I G H L I G H T
    //--------------------------------------------------------
    'Highlight' => array(
        'name' => __('Highlight', 'ATP_ADMIN_SITE'),
        'value' => 'highlight',
        'options' => array(
            array(
                'name' => __('Highlight BG Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to display for the highlight background.',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Highlight Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to display for the text.',
                'id' => 'textcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Highlight Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display as highlight.',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            )
        )
    ),
    // H I G H L I G H T 
    //--------------------------------------------------------
    'Highlight2' => array(
        'name' => __('Highlight 2', 'ATP_ADMIN_SITE'),
        'value' => 'highlight2',
        'options' => array(
            array(
                'name' => __('Highlight Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to display for the text.',
                'id' => 'textcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Highlight Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display as highlight.',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            )
        )
    ),
    // F A N C Y   A M P E R S A N D 
    //--------------------------------------------------------
    'Fancy Ampersand' => array(
        'name' => __('Fancy Ampersand', 'ATP_ADMIN_SITE'),
        'value' => 'fancy_ampersand',
        'options' => array(
            array(
                'name' => __('Ampersand Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to use for ampersand.',
                'id' => 'color',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Ampersand Size', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter size you want display. Example: 24px',
                'id' => 'size',
                'std' => '',
                'type' => 'text',
                'inputsize' => '44'
            )
        )
    ),
    
    // F A N C Y   H E A D I N G 
    //--------------------------------------------------------
    'Fancy Heading' => array(
        'name' => __('Fancy Heading', 'ATP_ADMIN_SITE'),
        'value' => 'fancyheading',
        'options' => array(
            
            array(
                'name' => __('Heading Size', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the heading size you wish to use.',
                'id' => 'heading',
                'std' => '',
                'options' => array(
                    '' => 'Choose Heading Size',
                    'h1' => 'h1',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                    'h6' => 'h6'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Heading Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the text color you wish to use.',
                'info' => '(optional)',
                'id' => 'textcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Heading Background Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the text Backgrouund color you wish to use.',
                'info' => '(optional)',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Heading Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the Heading alignment you wish to display.',
                'info' => '(optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'textleft' => 'Left',
                    'textright' => 'Right',
                    'textcenter' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Heading Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to use for Heading.',
                'id' => 'text',
                'std' => '',
                'type' => 'text'
            )
        )
    ),
    
    
    /*	S T Y L E D   L I S T S  */
    'List' => array(
        'name' => __('List', 'ATP_ADMIN_SITE'),
        'value' => 'styledlist',
        'options' => array(
            array(
                'name' => __('List Style', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the list style you wish to use.',
                'id' => 'style',
                'std' => '',
                'options' => array(
                    'disc' => 'disc',
                    'circle' => 'circle',
                    'square' => 'square',
                    'arrow1' => 'arrow1',
                    'arrow2' => 'arrow2',
                    'arrow3' => 'arrow3',
                    'arrow4' => 'arrow4',
                    'arrow5' => 'arrow5',
                    'bullet1' => 'bullet1',
                    'bullet2' => 'bullet2',
                    'bullet3' => 'bullet3',
                    'bullet4' => 'bullet4',
                    'bullet5' => 'bullet5',
                    'star1' => 'star1',
                    'star2' => 'star2',
                    'star3' => 'star3',
                    'plus' => 'plus',
                    'minus' => 'minus',
                    'pointer' => 'pointer',
                    'style1' => 'style1',
                    'check' => 'check'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the color variation',
                'info' => '(optional)',
                'id' => 'color',
                'std' => '',
                'options' => array(
                    'black' => 'Black',
                    'blue' => 'Blue',
                    'cyan' => 'Cyan',
                    'green' => 'Green',
                    'magenta' => 'Magenta',
                    'navy' => 'Navy',
                    'orange' => 'Orange',
                    'pink' => 'Pink',
                    'red' => 'Red',
                    'yellow' => 'Yellow'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Content', 'ATP_ADMIN_SITE'),
                'desc' => 'For List Items use HTML Elements &lt;ul&gt;&lt;li&gt;List Item&lt;/li>&lt;/ul>',
                'id' => 'content',
                'std' => '',
                'type' => 'textarea'
            )
        )
    ),
    // F A N C Y   I C O N S
    //---------------------------------------------------------
    'Icons' => array(
        'name' => __('Icons', 'ATP_ADMIN_SITE'),
        'value' => 'icon',
        'options' => array(
            
            array(
                'name' => __('Add FontAwesome Icon Name', 'ATP_ADMIN_SITE'),
                'desc' => 'Place icon name example fa-spinner - For list of icons go to : <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome Icons List</a>',
                'id' => 'icon',
                'std' => '',
                'type' => 'text'
            ),
            
            array(
                'name' => __('Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the color variation',
                'info' => '(optional)',
                'id' => 'color',
                'std' => '',
                'type' => 'color'
            ),
            
            array(
                'name' => __('Background Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the BG color ',
                'info' => '(optional)',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Border Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the Border color ',
                'info' => '(optional)',
                'id' => 'bordercolor',
                'std' => '',
                'type' => 'color'
            ),
            
            array(
                'name' => __('Select Icon Size', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the size of the icon. Details on sizes you can view here <a href="http://fortawesome.github.io/Font-Awesome/examples/" target="_blank">Examples</a>',
                'info' => '(optional)',
                'id' => 'size',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'fa-lg' => 'fa-lg',
                    'fa-2x' => 'fa-2x',
                    'fa-3x' => 'fa-3x',
                    'fa-4x' => 'fa-4x',
                    'fa-5x' => 'fa-5x'
                ),
                'type' => 'select'
            ),
            
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for Icon.',
                'info' => '(optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),			
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),
            
        )
    ),
    
    // BUTTON
    //--------------------------------------------------------
    'Buttons' => array(
        'name' => __('Button', 'ATP_ADMIN_SITE'),
        'value' => 'Button',
        'options' => array(
            array(
                'name' => __('ID', 'ATP_ADMIN_SITE'),
                'info' => '(Optional)',
                'id' => 'id',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
			  array(
                'name' => __('Add FontAwesome Icon Name', 'ATP_ADMIN_SITE'),
                'desc' => 'Place icon name example fa-spinner - For list of icons go to : <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome Icons List</a>',
                'id' => 'icon',
                'std' => '',
                'type' => 'text'
            ),
            array(
                'name' => __('Class', 'ATP_ADMIN_SITE'),
                'info' => '(Optional)',
                'id' => 'subclass',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Link URL', 'ATP_ADMIN_SITE'),
                'id' => 'link',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Link Target ', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose option when reader clicks on the link.',
                'info' => '(Optional)',
                'id' => 'linktarget',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    '_blank' => 'Open the linked document in a new window or tab',
                    '_self' => 'Open the linked document in the same frame as it was clicked.',
                    '_parent' => 'Open the linked document in the parent frameset',
                    '_top' => 'Open the linked document in the full body of the window'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Lightbox', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to display button Lightbox.',
                'info' => '(Optional)',
                'id' => 'lightbox',
                'std' => '',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the color variation',
                'info' => '(Optional)',
                'id' => 'color',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'greensea' => 'Green Sea',
                    'nephritis' => 'Nephritis',
                    'belizehole' => 'Belize Hole',
                    'wisteria' => 'Wisteria',
                    'midnightblue' => 'Midnight Blue',
                    'orange' => 'Orange',
                    'pumpkin' => 'Pumpkin',
                    'pomegranate' => 'Pomegranate',
                    'silver' => 'Silver',
                    'abestos' => 'Abestos',
                    'black' => 'Black',
                    'white' => 'White'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for a button',
                'info' => '(Optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('BG Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Button background color default state',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Hover BG Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Button background color on hover state',
                'id' => 'hoverbgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Hover Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Button Text color on hover state',
                'id' => 'hovertextcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Button Text color default state',
                'id' => 'textcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Button Size', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the button size',
                'id' => 'size',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    '' => 'Choose one...',
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large'
                )
            ),
            array(
                'name' => __('Button Style', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the button Style',
                'id' => 'border',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    'flat' => 'Flat',
                    'border' => 'Border'
                )
            ),
            array(
                'name' => __('Full Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to display button in full width and uncheck if you wish to use specific width below.',
                'info' => '(Optional)',
                'id' => 'fullwidth',
                'std' => '',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Button Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Use px as units for width, do not leave only integers.',
                'info' => '(Optional)',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            
            array(
                'name' => __('Button Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display for button',
                'id' => 'text',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),

        )
    ),
    
    // D I V I D E R S
    //--------------------------------------------------------
    'Divider' => array(
        'name' => __('Divider', 'ATP_ADMIN_SITE'),
        'value' => 'divider',
        'subtype' => true,
        'options' => array(
            array(
                'name' => __('Clear Both', 'ATP_ADMIN_SITE'),
                'value' => 'clear',
                'options' => array()
            ),
            array(
                'name' => __('Divider', 'ATP_ADMIN_SITE'),
                'value' => 'divider',
                'options' => array(
                    array(
                        'name' => __('Style:', 'ATP_ADMIN_SITE'),
                        'desc' => 'Select the Style for your Divider.',
                        'id' => 'dividertype',
                        'std' => '',
                        'options' => array(
                            'thin' => 'Thin Divider',
                            'fat' => 'Fat Divider',
                            'dotted' => 'Dotted Divider',
                            'dashed' => 'Dashed Divider'
                        ),
                        'type' => 'select'
                    ),
                    array(
                        'name' => __('Margin:', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter margin property using px.',
                        'id' => 'margin',
                        'info' => '(optional)',
                        'std' => '',
                        'type' => 'text',
                        'inputsize' => '33'
                    ),
                    array(
                        'name' => __('Border Color:', 'ATP_ADMIN_SITE'),
                        'desc' => 'Select the border color',
                        'id' => 'bordercolor',
                        'info' => '(optional)',
                        'std' => '',
                        'type' => 'color'
                    )
                )
            ),
            array(
                'name' => __('Demo Space', 'ATP_ADMIN_SITE'),
                'value' => 'demo_space',
                'options' => array(
                    array(
                        'name' => __('Height', 'ATP_ADMIN_SITE'),
                        'desc' => 'Enter integer value for demo space',
                        'id' => 'height',
                        'std' => '',
                        'type' => 'text',
                        'inputsize' => '33'
                    )
                )
            ),
            array(
                'name' => __('Custom Divider', 'ATP_ADMIN_SITE'),
                'value' => 'custom_divider',
                'options' => array(
                    array(
                        'name' => __('Upload Image', 'ATP_ADMIN_SITE'),
                        'desc' => 'Upload Image for the Divider.',
                        'id' => 'dividerimg',
                        'std' => '',
                        'type' => 'upload',
                        'inputsize' => '33'
                    )
                )
            )
        )
    ),
    
    // F A N C Y   T O G G L E 
    //--------------------------------------------------------
    'Toggle' => array(
        'name' => __('Toggle', 'ATP_ADMIN_SITE'),
        'value' => 'toggle',
        'options' => array(
            array(
                'name' => __('Fancy Toggle. Heading', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to use as Fancy Toggle Heading',
                'id' => 'heading',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Fancy Toggle Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to use as Fancy Toggle Content',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),
        )
    ),
    
    // B O X E S 
    //--------------------------------------------------------
    'Boxes' => array(
        'name' => __('Boxes', 'ATP_ADMIN_SITE'),
        'value' => 'Boxes',
        'subtype' => true,
        'options' => array(
            
            // F A N C Y   B O X 
            //--------------------------------------------------------
            array(
                'name' => __('Fancy Box', 'ATP_ADMIN_SITE'),
                'value' => 'fancybox',
                'options' => array(
                    array(
                        'name' => __('Title', 'ATP_ADMIN_SITE'),
                        'desc' => 'Type text you wish to display as Title for Fancy Box',
                        'id' => 'title',
                        'std' => '',
                        'type' => 'text',
                        'inputsize' => '53'
                    ),
                    array(
                        'name' => __('Box Content', 'ATP_ADMIN_SITE'),
                        'desc' => 'Type content you wish to display for Fancy Box',
                        'id' => 'text',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Title Color', 'ATP_ADMIN_SITE'),
                        'info' => '(Optional)',
                        'id' => 'titlecolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Title BG Color', 'ATP_ADMIN_SITE'),
                        'info' => '(Optional)',
                        'id' => 'titlebgcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Text Color', 'ATP_ADMIN_SITE'),
                        'info' => '(Optional)',
                        'id' => 'textcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Box BG Color', 'ATP_ADMIN_SITE'),
                        'info' => '(Optional)',
                        'id' => 'boxbgcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Corner Ribbon', 'ATP_ADMIN_SITE'),
                        'desc' => 'Corner Ribbon (Range from 01 - 64) for more details of the names you can check the ribbons bolder within the images folder',
                        'info' => '(Optional)',
                        'id' => 'ribbon',
                        'std' => '',
                        'type' => 'select',
                        'options' => $atp_ribbons
                    ),
					array(
						'name' => __('Animations', 'ATP_ADMIN_SITE'),
						'desc' => 'Select an animation effect for the element',
						'info' => '(Optional)',
						'id' => 'animation',
						'std' => '',
						'type' => 'select',
						'options' => $iva_anim,
					)					
                )
            ),
            // F R A M E D   B O X 
            //--------------------------------------------------------
            array(
                'name' => __('Framed Box', 'ATP_ADMIN_SITE'),
                'value' => 'framebox',
                'options' => array(
                    array(
                        'name' => __('Box Content', 'ATP_ADMIN_SITE'),
                        'desc' => 'Type content you wish to display for Fancy Box',
                        'id' => 'text',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Box BG Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose the color for Box Background',
                        'info' => '(Optional)',
                        'id' => 'boxbgcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Text Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose the color for Box Text',
                        'info' => '(Optional)',
                        'id' => 'textcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Border Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose the color for Box Border',
                        'info' => '(Optional)',
                        'id' => 'bordercolor',
                        'std' => '',
                        'type' => 'color'
                    ),
					array(
						'name' => __('Animations', 'ATP_ADMIN_SITE'),
						'desc' => 'Select an animation effect for the element',
						'info' => '(Optional)',
						'id' => 'animation',
						'std' => '',
						'type' => 'select',
						'options' => $iva_anim,
					)					
                )
            ),
            // Teaser Box
            //--------------------------------------------------------
            'Teaser Box' => array(
                'name' => __('Teaser Box', 'ATP_ADMIN_SITE'),
                'value' => 'teaserbox',
                'options' => array(
                    array(
                        'name' => __('BG Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose the color for background',
                        'info' => '(Optional)',
                        'id' => 'bgcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
                    array(
                        'name' => __('Link URL', 'ATP_ADMIN_SITE'),
                        'id' => 'buttonlink',
                        'std' => '',
                        'type' => 'text',
                        'inputsize' => '53'
                    ),
                    array(
                        'name' => __('Link Target ', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose option when reader clicks on the link.',
                        'info' => '(Optional)',
                        'id' => 'linktarget',
                        'std' => '',
                        'options' => array(
                            '' => 'Choose one...',
                            '_blank' => 'Open the linked document in a new window or tab',
                            '_self' => 'Open the linked document in the same frame as it was clicked.',
                            '_parent' => 'Open the linked document in the parent frameset',
                            '_top' => 'Open the linked document in the full body of the window'
                        ),
                        'type' => 'select'
                    ),
                    array(
                        'name' => __('Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Select the color variation',
                        'info' => '(Optional)',
                        'id' => 'color',
                        'std' => '',
                        'options' => array(
                            '' => 'Choose one...',
                            'greensea' => 'Green Sea',
                            'nephritis' => 'Nephritis',
                            'belizehole' => 'Belize Hole',
                            'wisteria' => 'Wisteria',
                            'midnightblue' => 'Midnight Blue',
                            'orange' => 'Orange',
                            'pumpkin' => 'Pumpkin',
                            'pomegranate' => 'Pomegranate',
                            'silver' => 'Silver',
                            'abestos' => 'Abestos',
                            'black' => 'Black',
                            'white' => 'White'
                        ),
                        'type' => 'select'
                    ),
                    array(
                        'name' => __('Button Size', 'ATP_ADMIN_SITE'),
                        'desc' => 'Select the button size',
                        'id' => 'buttonsize',
                        'std' => '',
                        'type' => 'select',
                        'options' => array(
                            '' => 'Choose one...',
                            'small' => 'Small',
                            'medium' => 'Medium',
                            'large' => 'Large'
                        )
                    ),
                    array(
                        'name' => __('Button Style', 'ATP_ADMIN_SITE'),
                        'desc' => 'Select the button Style',
                        'id' => 'border',
                        'std' => '',
                        'type' => 'select',
                        'options' => array(
                            'flat' => 'Flat',
                            'border' => 'Border'
                        )
                    ),
                    array(
                        'name' => __('Button Text', 'ATP_ADMIN_SITE'),
                        'desc' => 'Type the text you wish to display for button',
                        'id' => 'buttontext',
                        'std' => '',
                        'type' => 'text',
                        'inputsize' => '53'
                    ),
                    
                    array(
                        'name' => __('Teaser Content', 'ATP_ADMIN_SITE'),
                        'desc' => 'Type content you wish to display for Teaser Box',
                        'id' => 'text',
                        'std' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'name' => __('Text Color', 'ATP_ADMIN_SITE'),
                        'desc' => 'Choose the color for Text',
                        'info' => '(Optional)',
                        'id' => 'textcolor',
                        'std' => '',
                        'type' => 'color'
                    ),
					array(
						'name' => __('Animations', 'ATP_ADMIN_SITE'),
						'desc' => 'Select an animation effect for the element',
						'info' => '(Optional)',
						'id' => 'animation',
						'std' => '',
						'type' => 'select',
						'options' => $iva_anim,
					)					
                )
            )
            
        )
    ),
    // E N D  - BOXES
    
    // M E S S A G E   B O X  
    //--------------------------------------------------------
    'Message Box' => array(
        'name' => __('Message Box', 'ATP_ADMIN_SITE'),
        'value' => 'messagebox',
        'options' => array(
            array(
                'name' => __('Message Type', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the Message Box Type Error, Notice, Success etc',
                'id' => 'msgtype',
                'std' => '',
                'options' => array(
                    'error' => 'Error',
                    'info' => 'Info',
                    'alert' => 'Alert',
                    'success' => 'Success'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Message Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the content you wish to display for the message box',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Close', 'ATP_ADMIN_SITE'),
                'desc' => 'If You checked close Button Display',
                'id' => 'close',
                'std' => '',
                'type' => 'checkbox'
            ),
			array(
				'name' => __('Animations', 'ATP_ADMIN_SITE'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim,
			)
        )
    ),
    
    // N O T E   B O X  
    //--------------------------------------------------------
    'Note Box' => array(
        'name' => __('Note Box', 'ATP_ADMIN_SITE'),
        'value' => 'notebox',
        'options' => array(
            array(
                'name' => __('Title', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display for the Note Box Heading',
                'info' => '(optional)',
                'id' => 'title',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'info' => '(Optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Use % or px as units for width, do not leave only numbers.',
                'info' => '(Optional)',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Message Text', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the content you wish to display for the Note Box',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
			array(
				'name' => __('Animations', 'ATP_ADMIN_SITE'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim,
			)
        )
    ),
    // A C C O R D I O N
    //--------------------------------------------------------
    'Accordion' => array(
        'name' => __('Accordion', 'ATP_ADMIN_SITE'),
        'value' => 'accordion',
        'options' => array(
            array(
                'name' => __('Accordion Columns', 'ATP_ADMIN_SITE'),
                'desc' => 'Accordion Columns.',
                'id' => 'accordion_col',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    '02' => 'Two Columns',
                    '03' => 'Three Columns',
                    '04' => 'Four Columns'
                )
            ),
            array(
                'name' => __('Animations', 'ATP_ADMIN_SITE'),
                'desc' => 'Select an animation effect for the element',
                'info' => '(Optional)',
                'id' => 'animation',
                'std' => '',
                'type' => 'select',
                'options' => $iva_anim
            )
        )
    ),
    
 
    // I M A G E
    //--------------------------------------------------------
    'Image' => array(
        'name' => __('Image', 'ATP_ADMIN_SITE'),
        'value' => 'image',
        'options' => array(
            array(
                'name' => __('Image URL', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the URL of the image from the media library that you wish to use.',
                'id' => 'imagesrc',
                'std' => '',
                'type' => 'upload',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Title', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the title attribute for the image',
                'id' => 'title',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Caption', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter the caption text for the image',
                'info' => '(Optional)',
                'id' => 'caption',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Class', 'ATP_ADMIN_SITE'),
                'desc' => 'Add sub class for the image if you want to assign any new class for the image',
                'info' => '(Optional)',
                'id' => 'class',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Link URL', 'ATP_ADMIN_SITE'),
                'desc' => 'Link url to the if you wish to link to any specific location when clicked on the image',
                'info' => '(Optional)',
                'id' => 'alink',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Link Target', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose option when reader clicks on the image linked.',
                'info' => '(Optional)',
                'id' => 'target',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    '_blank' => 'Open the linked document in a new window or tab',
                    '_self' => 'Open the linked document in the same frame as it was clicked.',
                    '_parent' => 'Open the linked document in the parent frameset',
                    '_top' => 'Open the linked document in the full body of the window'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Lightbox', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to use Lightbox for the image',
                'info' => '(Optional)',
                'id' => 'lightbox',
                'std' => '',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for your image.',
                'info' => '(Optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Use px as units for width',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Height', 'ATP_ADMIN_SITE'),
                'desc' => 'Use px as units for height',
                'id' => 'height',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
			 array(
			'name' => __('Animations', 'ATP_ADMIN_SITE'),
			'desc' => 'Select an animation effect for the element',
			'info' => '(Optional)',
			'id' => 'animation',
			'std' => '',
			'type' => 'select',
			'options' => $iva_anim
			)
            
        )
    ),
    // P R O G R E S S B A R
    //--------------------------------------------------------
    'Progress Bar' => array(
        'name' => __('Progress Bar', 'ATP_ADMIN_SITE'),
        'value' => 'progressbar',
        'options' => array(
            array(
                'name' => __('Percentage', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter the percentage for the progress bar.',
                'id' => 'percentage',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Title', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display for Bar Title',
                'id' => 'title',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the color for the Progress Bar',
                'id' => 'color',
                'std' => '',
                'type' => 'color',
                'inputsize' => ''
            ),
            array(
                'name' => __('BgColor', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the color for the Progress Bar Bgcolor',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color',
                'inputsize' => ''
            ),
			 array(
			'name' => __('Animations', 'ATP_ADMIN_SITE'),
			'desc' => 'Select an animation effect for the element',
			'info' => '(Optional)',
			'id' => 'animation',
			'std' => '',
			'type' => 'select',
			'options' => $iva_anim
			)
        )
    ),
    
    // P R O G R E S S  C I R C L E
    //--------------------------------------------------------
    'Progress Circle' => array(
        'name' => __('Progress Circle', 'ATP_ADMIN_SITE'),
        'value' => 'progresscircle',
        'options' => array(
            array(
                'name' => __('Progress Circle Columns', 'ATP_ADMIN_SITE'),
                'desc' => 'Progress Circle Columns.',
                'id' => 'pcirclecolumns',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    '03' => 'Three Columns',
                    '04' => 'Four Columns'
                )
            ),
			array(
				'name' => __('Animations', 'ATP_ADMIN_SITE'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim
			)
        )
    ),
    /* ----------------------------------------------------- */
    /* Section */
    /* ----------------------------------------------------- */
    
    'Section' => array(
        'name' => __('Section', 'ATP_ADMIN_SITE'),
        'value' => 'section',
        'options' => array(
            array(
                'name' => __('Section BG Image', 'ATP_ADMIN_SITE'),
                'desc' => 'Upload Image you want to display for the Section background.',
                'id' => 'bgimage',
                'std' => '',
                'type' => 'upload'
            ),
            array(
                'name' => __('Section BG Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to display for the Section background.',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Section Text Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose the color you want to display for the text.',
                'id' => 'textcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Section Padding', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter padding ex: 20px 0px 20px 0px. Make sure you don\'t use padding on left and right side. If you don\'t want padding then make it 0px not just 0',
                'id' => 'padding',
                'std' => '',
                'type' => 'text'
            ),
            array(
                'name' => __('Section Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display as Section.',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            )
        )
    ),
    
    //S T A F F
    //--------------------------------------------------------
    'Staff' => array(
        'name' => __('Staff Box', 'ATP_ADMIN_SITE'),
        'value' => 'staff',
        'options' => array(
            array(
                'name' => __('Photo', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the photo from media library or from your desktop but make sure its width should not be less than 420px to make it responsive.',
                'id' => 'photo',
                'std' => '',
                'type' => 'upload',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Name', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text or title you wish to display as Name',
                'id' => 'title',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Role', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text to resemble to role of a person',
                'id' => 'role',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Sociables', 'ATP_ADMIN_SITE'),
                'desc' => 'Add Sociables to the relevant Staff.',
                'id' => 'selectsociable',
                'std' => '',
                'type' => 'select',
                'options' => $staff_social,
                'inputsize' => '70'
            ),
            
            array(
                'name' => __('Blogger', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Blogger URL ',
                'id' => 'blogger',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Dribbble', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Dribble URL',
                'id' => 'dribbble',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            
            array(
                'name' => __('Delicious', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Delicous URL',
                'id' => 'delicious',
                'std' => '',
                'class' => 'class_hide',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Digg', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Digg URL',
                'id' => 'digg',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Facebook', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Facebook URL',
                'id' => 'facebook',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Flickr', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Flickr URL',
                'id' => 'flickr',
                'std' => '',
                'class' => 'class_hide',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Forrst', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Forrst URL',
                'id' => 'forrst',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Google', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Google URL',
                'id' => 'google',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Linkedin', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Linkedin URL',
                'id' => 'linkedin',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Pinterest', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Pinterest URL',
                'id' => 'pinterest',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Skype', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Skype URL',
                'id' => 'skype',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Stumbleupon', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Stumbleupon URL',
                'id' => 'stumbleupon',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Twitter', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Twitter URL',
                'id' => 'twitter',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Yahoo', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Yahoo URL',
                'id' => 'yahoo',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            array(
                'name' => __('Youtube', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter Youtube URL',
                'id' => 'youtube',
                'class' => 'class_hide',
                'std' => '',
                'type' => 'text_rm',
                'inputsize' => '70'
            ),
            
            array(
                'name' => __('Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the text you wish to display for the staff box or profile summary.',
                'id' => 'content',
                'std' => '',
                'type' => 'textarea',
                'inputsize' => '70'
            ),
			 array(
			'name' => __('Animations', 'ATP_ADMIN_SITE'),
			'desc' => 'Select an animation effect for the element',
			'info' => '(Optional)',
			'id' => 'animation',
			'std' => '',
			'type' => 'select',
			'options' => $iva_anim
			)
        )
    ),
    // GOOGLE MAP
    //--------------------------------------------------------
    'Google Map' => array(
        'name' => __('Google Map', 'ATP_ADMIN_SITE'),
        'value' => 'gmap',
        'options' => array(
            array(
                'name' => __('Width', 'ATP_ADMIN_SITE'),
                'desc' => 'Use only Numbers Ex:300.',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Height', 'ATP_ADMIN_SITE'),
                'desc' => 'Use only Numbers Ex:300.',
                'id' => 'height',
                'std' => '300',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Address', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the address you wish to display for the map u can use multiple address EX: Address1 | Address2 | Address3 .',
                'info' => '(optional)',
                'id' => 'address',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Latitude', 'ATP_ADMIN_SITE'),
                'id' => 'latitude',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('longitude', 'ATP_ADMIN_SITE'),
                'id' => 'longitude',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Zoom', 'ATP_ADMIN_SITE'),
                'desc' => 'The initial Map zoom level. Required. (Zoom Range : 1-19)',
                'id' => 'zoom',
                'std' => '12',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Marker Description', 'ATP_ADMIN_SITE'),
                'desc' => 'You can use multiple Marker Description - Example: Description1 | Description2 | Description3.',
                'id' => 'marker_desc',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Info Window', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to open the marker window by default',
                'id' => 'infowindow',
                'std' => '',
                'type' => 'checkbox',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Controller', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to disable the Controller',
                'id' => 'controller',
                'std' => '',
                'type' => 'checkbox',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Google map stylers Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Use Colorpicker to Googlemap stylers color',
                'id' => 'stylerscolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Gmap Types', 'ATP_ADMIN_SITE'),
                'desc' => 'HYBRID: <em>This map type displays a transparent layer of major streets on satellite images.</em> <br> ROADMAP: <em>This map type displays a normal street map.<br> SATELLITE: This map type displays satellite images.</em><br> TERRAIN: <em>This map type displays maps with physical features such as terrain and vegetation.</em>',
                'id' => 'types',
                'std' => 'ROADMAP',
                'options' => array(
                    'ROADMAP' => 'Default road map',
                    'SATELLITE' => 'Google Earth satellite',
                    'HYBRID' => 'Hybrid',
                    'TERRAIN' => 'Terain'
                ),
                'type' => 'select'
            )
        )
    ),
    // TWITTER
    //--------------------------------------------------------
    'Twitter' => array(
        'name' => __('Twitter Tweets', 'ATP_ADMIN_SITE'),
        'value' => 'twitter',
        'options' => array(
            array(
                'name' => __('Twitter Id', 'ATP_ADMIN_SITE'),
                'desc' => 'Twitter ID: <small>Use your Id from twitter url <em>http://twitter.com/<span style="color:red">username</span></em></small>',
                'id' => 'username',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
           
            array(
                'name' => __('Limit', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the number of tweets you wish to display.',
                'id' => 'limit',
                'std' => '4',
                'type' => 'text',
                'inputsize' => '30'
            ),
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),			
        )
    ),
    // END TWITTER
    // FLICKR
    //--------------------------------------------------------
    'Flickr' => array(
        'name' => __('Flickr Photos', 'ATP_ADMIN_SITE'),
        'value' => 'flickr',
        'options' => array(
            array(
                'name' => __('Flickr Id', 'ATP_ADMIN_SITE'),
                'desc' => 'Flickr ID: <small>find your Id from <a href="http://idgettr.com" target="_blank">idGettr</a></small>',
                'id' => 'id',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Limit', 'ATP_ADMIN_SITE'),
                'desc' => 'Flickr Photos Limit.',
                'id' => 'limit',
                'std' => '3',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Type', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose Photos Type',
                'id' => 'type',
                'std' => 'user',
                'options' => array(
                    'user' => 'User',
                    'group' => 'Group'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Display', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose Display Type',
                'id' => 'display',
                'std' => 'random',
                'options' => array(
                    'random' => 'Random',
                    'latest' => 'Latest'
                ),
                'type' => 'select'
            )
        )
    ),
    // END FLICKR
    // T A B S
    //--------------------------------------------------------
    'Tabs' => array(
        'name' => __('Tabs', 'ATP_ADMIN_SITE'),
        'value' => 'tabs',
        'options' => array(
            array(
                'name' => __('Tabs Columns', 'ATP_ADMIN_SITE'),
                'desc' => 'Tabs Columns.',
                'id' => 'tab',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    '02' => 'Two Columns',
                    '03' => 'Three Columns',
                    '04' => 'Four Columns'
                )
            ),
            array(
                'name' => __('Tabs Type  ', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose Tabs Type Horizontal/Vertical',
                'id' => 'ctabs',
                'std' => '',
                'options' => array(
                    'horizontal' => 'Horizontal',
                    'vertical' => 'Vertical'
                ),
                'type' => 'select'
            ),
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),				
        )
    ),
    // CONTACT INFO
    //--------------------------------------------------------
    'Contact Info' => array(
        'name' => __('Contact Info', 'ATP_ADMIN_SITE'),
        'value' => 'contactinfo',
        'options' => array(
            array(
                'name' => __('Name', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the Name or Company Name you wish to display.',
                'id' => 'name',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Address', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the Address you wish to display.',
                'id' => 'address',
                'std' => '',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Phone', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the Phone Number you wish to display.',
                'id' => 'phone',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Email', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the Email-ID you wish to display.',
                'id' => 'email',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Website URL', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the Link URL you wish to display. excluding http',
                'id' => 'link',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
			array(
				'name'    => __('Animations', 'ATP_ADMIN_SITE'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),			
        )
    ),
    // END CONTACTINFO
    
    // T E S T I M O N I A L 
    //--------------------------------------------------------
    'Testimonial List' => array(
        'name' => __('Testimonial List', 'ATP_ADMIN_SITE'),
        'value' => 'testimoniallist',
        'options' => array(
            array(
                'name' => __('Category', 'ATP_ADMIN_SITE'),
                'desc' => 'Hold Control/Command key to select multiple categories',
                'info' => '(optional)',
                'id' => 'category',
                'std' => '',
                'options' => $this->atp_variable('testimonial'),
                'type' => 'multiselect'
            ),
            array(
                'name' => __('Testimonial  Limit', 'ATP_ADMIN_SITE'),
                'desc' => 'Number of testimonials to display',
                'id' => 'limit',
                'std' => '4',
                'type' => 'text'
            )
        )
    ),
    // E N D   - T E S T I M O N I A L 
    
    
    // S E R V I C E S
    //--------------------------------------------------------
    'Services' => array(
        'name' => __('Services', 'ATP_ADMIN_SITE'),
        'value' => 'services',
        'options' => array(
            array(
                'name' => __('Upload Image', 'ATP_ADMIN_SITE'),
                'desc' => 'Image / Icon to represent the services box',
                'id' => 'image',
                'std' => '',
                'type' => 'upload'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for Icon.',
                'info' => '(optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
			array(
				'name'	=> __('Title','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the title you wish to display for the service',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
			),			
            array(
                'name' => __('Services Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the content you wish to display for the service',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
			 array(
			'name' => __('Animations', 'ATP_ADMIN_SITE'),
			'desc' => 'Select an animation effect for the element',
			'info' => '(Optional)',
			'id' => 'animation',
			'std' => '',
			'type' => 'select',
			'options' => $iva_anim
			)			
        )
    ),
    
    
    // S E R V I C E S - I C O N
    //--------------------------------------------------------
    'Services Icon' => array(
        'name' => __('Services Icon', 'ATP_ADMIN_SITE'),
        'value' => 'servicesicon',
        'options' => array(
            array(
                'name' => __('Add Font Awesome Icon Name', 'ATP_ADMIN_SITE'),
                'desc' => 'Go to Example: <a href="http://fortawesome.github.io/Font-Awesome/examples/" target="">Awesome Icons</a>',
                'id' => 'icon',
                'std' => '',
                'type' => 'text'
            ),
            array(
                'name' => __('Align', 'ATP_ADMIN_SITE'),
                'desc' => 'Select the alignment for Icon.',
                'info' => '(optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Icon Bgcolor', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose Icon Bg color',
                'id' => 'bgcolor',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('icon Color', 'ATP_ADMIN_SITE'),
                'desc' => 'Choose Icon Color',
                'id' => 'color',
                'std' => '',
                'type' => 'color'
            ),
            array(
                'name' => __('Title', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the heading title you wish to display for the services',
                'id' => 'title',
                'std' => '',
                'type' => 'text'
            ),
            array(
                'name' => __('Content', 'ATP_ADMIN_SITE'),
                'desc' => 'Type the content you wish to display for the services',
                'id' => 'text',
                'std' => '',
                'type' => 'textarea'
            ),
			 array(
			'name' => __('Animations', 'ATP_ADMIN_SITE'),
			'desc' => 'Select an animation effect for the element',
			'info' => '(Optional)',
			'id' => 'animation',
			'std' => '',
			'type' => 'select',
			'options' => $iva_anim
			)            
        )
    ),
	 // Blog 
    //--------------------------------------------------------
    'Blog' => array(
			'name'		=> __('Blog','ATP_ADMIN_SITE'),
			'value'		=> 'blog',
			'options'	=> array(
				array(
					'name'	=> __('Category','ATP_ADMIN_SITE'),
					'desc'	=> 'Hold Control/Command key to select multiple categories',
					'id'	=> 'cat',
					'std'	=> '',
					'options'=>	$this->atp_variable('posts'),
					'type'	=> 'multiselect',
				),
				array(
					'name'	=> __('Blog Posts Limit','ATP_ADMIN_SITE'),
					'desc'	=> 'Number of items to show per page',
					'id'	=> 'limit',
					'std'	=> '-1',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('Blog Post Meta','ATP_ADMIN_SITE'),
					'desc'	=> 'Check this if you wish to display  Post Meta for the blog.',
					'id'	=> 'postmeta',
					'std'	=> true,
					'type'	=> 'checkbox',
				),
				array(
					'name'	=> __('Pagination','ATP_ADMIN_SITE'),
					'desc'	=> 'Check this if you wish to display pagination for the blog.',
					'id'	=> 'pagination',
					'std'	=> true,
					'type'	=> 'checkbox',
				),
			),
		),
    // Blog Slider
    //--------------------------------------------------------
    'Carousel Blog' => array(
        'name' => __('Carousel - Blog', 'ATP_ADMIN_SITE'),
        'value' => 'blogcarousel',
        'options' => array(
            array(
                'name'		 => __('Category', 'ATP_ADMIN_SITE'),
                'desc'		 => 'Hold Control/Command key to select multiple categories',
                'id'		 => 'cat',
                'std'		 => '',
                'options'	 => $this->atp_variable('posts'),
                'type'		 => 'multiselect'
            ),
            array(
                'name'	 => __('Blog Items Limit', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Number of Blog Posts to show',
                'id'	 => 'limit',
                'std'	 => '5',
                'type'	 => 'text'
            ),
            array(
                'name'	 => __('Carousel Title', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Enter The Title',
                'id'	 => 'title',
                'std'	 => '',
                'type'	 => 'text'
            ),
			array(
                'name'	 => __('Items Per Carousel', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Number of Items to show per carousel',
                'id'	 => 'items',
                'std'	 => '',
                'type'	 => 'text'
            ),

            array(
                'name'	 => __('Blog Carousel Styles', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Select the Blog Carousel Styles',
                'info'	 => '(Optional)',
                'id'	 => 'style',
                'std'	 => '',
                'options' 	=> array(
                    '' 		=> 'Choose Style...',
                    'style1'=> 'Style1',
                    'style2'=> 'Style2'
                ),
                'type' 		=> 'select'
            )
        )
    ),
   
	// Carousels
    //--------------------------------------------------------
    'Carousel' => array(
        'name' => __('Carousels', 'ATP_ADMIN_SITE'),
        'value' => 'carousel',
        'options' => array(
            array(
                'name'		 => __('Post Types', 'ATP_ADMIN_SITE'),
                'desc'		 => 'Select Post Types for which you wish to use the carousels',
                'id'		 => 'type',
                'std'		 => '',
                'options'	 => array( 
						''			=> 'Select Post Type',
						'albums'	=> 'Albums',
						'artists'	=> 'Artists',
						'video'		=> 'Videos',
						'gallery'	=> 'Gallery'),
                'type'		 => 'select'
            ),
			array(
					'name' 		=> __('Labels', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple items',
					'id' 		=> 'alb_labelcat',
					'class' 	=> 'albums album_label',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('album_label'),
					'type' 		=> 'multiselect'
			),
			array(
					'name' 		=> __('Genres', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple items',
					'id' 		=> 'alb_genrescat',
					'class' 	=> 'albums album_genres',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('album_genres'),
					'type' 		=> 'multiselect'
			),
			array(
					'name' 		=> __('Artist Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple items',
					'id' 		=> 'art_artistcat',
					'class'  	=> 'artists artist_cat',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('artist_cat'),
					'type' 		=> 'multiselect'
			),
			array(
					'name' 		=> __('Video Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple items',
					'id' 		=> 'vid_videocat',
					'class' 	=> 'video videos',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('video'),
					'type' 		=> 'multiselect'

			),
			array(
					'name' 		=> __('Gallery Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple items',
					'id' 		=> 'gal_galcat',
					'std' 		=> '',
					'class' 	=> 'gallery gallery_cat',
					'options' 	=> $this->atp_variable('gallery'),
					'type' 		=> 'multiselect'
					),
			array(
                'name'	 => __('Total Items Limit', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Number of Posts to show in the complete carousel',
                'id'	 => 'limit',
                'std'	 => '5',
                'type'	 => 'text'
            ),
			array(
                'name'	 => __('Items Per Carousel', 'ATP_ADMIN_SITE'),
                'desc'	 => 'Number of Items to show per carousel',
                'id'	 => 'items',
                'std'	 => '4',
                'type'	 => 'text'
            ),
          
        )
    ),
   
   // A L B U M
	//--------------------------------------------------------
	'Album' 	=> array(
		'name' 	=> __('Album', 'ATP_ADMIN_SITE'),
		'value' => 'album',
		'options' => array(
				array(
					'name'	 => __('Album Select', 'ATP_ADMIN_SITE'),
					'id'	 => 'alb_select',
					'std'	 => '',
					'type'	 => 'select',
					'options' => array(
						'' 			 => 'Choose Type...',
						'categories' => 'Album List',
						'postids'	 => 'Album ID',
						'id'		 => 'Album Songs List'
					)
				),
				array(
					'name' 	=> __('Column', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Select the Albums Columns Layout Style',
					'id' 	=> 'alb_column',
					'class' => 'albumselect categories',
					'std' 	=> '4',
					'options' => array(
						'3' 	=> '3 Columns',
						'4' 	=> '4 Columns'
					),
					'type' => 'select'
				),

				array(
						'name'	=> __('Albums ID', 'ATP_ADMIN_SITE'),
						'desc'	=> 'Enter the Albums Post-ID with comma separated if you wish to display more than one post',
						'id' 	=> 'alb_postid',
						'class' => 'albumselect postids',
						'std' 	=> '4',
						'type'	=> 'text'
				),
				array(
						'name'	=> __('Album ID', 'ATP_ADMIN_SITE'),
						'desc'	=> 'Type the Album Post-ID you wish to display songs from',
						'id' 	=> 'alb_id_display',
						'class' => 'albumselect id',
						'std' 	=> '4',
						'type'	=> 'text'
				),
				array(
						'name'	=> __('Album Limit', 'ATP_ADMIN_SITE'),
						'desc'	=> 'Type the number of items you wish to display per page',
						'id' 	=> 'alb_limit',
						'class' => 'albumselect categories',
						'std' 	=> '4',
						'type'	=> 'text'
				),
				array(
						'name' 		=> __('Label Category', 'ATP_ADMIN_SITE'),
						'desc' 		=> 'Hold Control/Command key to select multiple categories',
						'info' 		=> '(optional)',
						'id' 		=> 'alb_labelcat',
						'class' 	=> 'albumselect categories',
						'std' 		=> '',
						'options' 	=> $this->atp_variable('album_label'),
						'type' 		=> 'multiselect'
				),
				array(
						'name' 		=> __('Genres Category', 'ATP_ADMIN_SITE'),
						'desc' 		=> 'Hold Control/Command key to select multiple categories',
						'info' 		=> '(optional)',
						'class' 	=> 'albumselect categories',
						'id' 		=> 'alb_genrescat',
						'std' 		=> '',
						'options' 	=> $this->atp_variable('album_genres'),
						'type' 		=> 'multiselect'
				),

				array(
						'name'	 => __('Display Order', 'ATP_ADMIN_SITE'),
						'desc'	 => 'Check this if you wish to display Orderby, order from the Theme Options.',
						'id'	 => 'alb_ordering',
						'class'  => 'albumselect categories',
						'std'	 => '',
						'type'	 => 'checkbox'
				),

				array(
						'name'	 => __('Pagination', 'ATP_ADMIN_SITE'),
						'desc'	 => 'Check this if you wish to disable the pagination.',
						'id'	 => 'alb_pagination',
						'class'  => 'albumselect categories',
						'std'	 => '',
						'type'	 => 'checkbox'
				),
		)
	),

	//Events
	//---------------------------------------------------------

	'Event' 	=> array(
			'name' 	=> __('Events', 'ATP_ADMIN_SITE'),
			'value' => 'events',
			'options' => array(
					array(
					'name' 		=> __('Events Select', 'ATP_ADMIN_SITE'),
					'id' 		=> 'eve_sorting',
					'std' 		=> 'past_events',
					'options'	=> array(
										'' 			 		=> 'Select Option...',
										'past_events'		=> 'Past Events',
										'upcoming_events'	=> 'Upcoming Events',
										'postids'			=> 'Event Ids'		
									),
					'type' => 'select'
				),
				
				array(
					'name' 		=> __('Style', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Select the Events Columns Layout Style',
					'id' 		=> 'eve_style',
					'std' 		=> '',
					'class'		=> 'shortevent past_events upcoming_events',
					'options'	=> array(
									'style1'    => 'style1',
									'style2'	=> 'style2'
								),
					'type' => 'select'
				),
				array(
					'name'	=> __('Event ID', 'ATP_ADMIN_SITE'),
					'desc'	=> 'Enter the Event Post-ID with comma separated if you wish to display more than one post',
					'id' 	=> 'eve_postid',
					'class'	=> 'shortevent postids',
					'std' 	=> '4',
					'type'	=> 'text'
				),
				array(
					'name'	=> __('Events Limit', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Type the number of items you wish to display per page',
					'id' 	=> 'eve_limit',
					'class'	=> 'shortevent past_events upcoming_events',
					'std' 	=> '4',
					'type'	=> 'text'
				),
				array(
					'name' 		=> __('Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple categories',
					'info' 		=> '(optional)',
					'id' 		=> 'eve_cat',
					'class'		=> 'shortevent past_events upcoming_events',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('events'),
					'type' 		=> 'multiselect'
				),
						
				array(
					'name'	=> __('Pagination', 'ATP_ADMIN_SITE'),
					'desc'	=> 'Check this if you wish to disable the pagination.',
					'id'	=> 'eve_pagination',
					'class'	=> 'shortevent past_events upcoming_events',
					'std'	=> '',
					'type'	=> 'checkbox'
				),
			),
		),
	// A R T I S T
	//--------------------------------------------------------
	'Artist'	=> array(
		'name'	=> __('Artist', 'ATP_ADMIN_SITE'),
		'value'	=> 'artist',
		'options' => array(
				array(
					'name' => __('Artist Select', 'ATP_ADMIN_SITE'),
					'id'   => 'art_select',
					'std' => '',
					'type' => 'select',
					'options' => array(
						'' 					=> 'Choose Type...',
						'artist_cat' 		=> 'Artist Category',
						'artist_postids'	=> 'Artist ID'
					)
				),
		
				array(
					'name'	=> __('Style', 'ATP_ADMIN_SITE'),
					'desc'	=> 'Select the Artist Columns Layout Style',
					'id'	=> 'art_column',
					'std'	=> '4',
					'class'  => 'shortartist artist_cat',
					'options'	=> array(
						'3'		=> '3 Columns',
						'4'		=> '4 Columns'
					),
					'type' => 'select'
                ),
				array(
					'name' 		=> __('Artist Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple categories',
					'info' 		=> '(optional)',
					'id' 		=> 'art_artistcat',
					'class'  	=> 'shortartist artist_cat',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('artist_cat'),
					'type' 		=> 'multiselect'
				),
				
				array(
					'name' => __('Artist ID', 'ATP_ADMIN_SITE'),
					'desc' => 'Enter the Artist Post-ID with comma separated if you wish to display more than one post',
					'id'   => 'art_postid',
					'class'  => 'shortartist artist_postids',
					'std'  => '4',
					'type' => 'text'
				),
				array(
					'name' => __('Artist Limit', 'ATP_ADMIN_SITE'),
					'desc' => 'Type the number of items you wish to display per page',
					'id'   => 'art_limit',
					'class'  => 'shortartist artist_cat',
					'std'  => '4',
					'type' => 'text'
				),
				array(
					'name' => __('Pagination', 'ATP_ADMIN_SITE'),
					'desc' => 'Check this if you wish to disable the pagination.',
					'id'   => 'art_pagination',
					'class'  => 'shortartist artist_cat',
					'std'  => '',
					'type' => 'checkbox'
				),
		)
	),



	// G A L L E R Y
	//--------------------------------------------------------
	'Gallery' 		=> array(
		'name' 		=> __('Gallery', 'ATP_ADMIN_SITE'),
		'value' 	=> 'gallery',
		'options' 	=> array(
				array(
					'name' 		=> __('Gallery Select', 'ATP_ADMIN_SITE'),
					'id' 		=> 'gal_select',
					'std' 		=> '',
					'type'		=> 'select',
					'options' 	=> array(
							'' 			 => 'Choose Type...',
							'gallery_cat' 		=> 'Gallery List',
							'gallery_postids'	=> 'Gallery ID'
					)
				),
				array(
					'name' 		=> __('Style', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Select the Gallery Columns Layout Style',
					'id' 		=> 'gal_column',
					'std' 		=> '4',
					'class' => 'shortgallery gallery_cat',
					'options'	=> array(
						'3'		=> '3 Columns',
						'4'		=> '4 Columns'
					),
					'type' => 'select'
					),
					
				array(
					'name' => __('Gallery ID', 'ATP_ADMIN_SITE'),
					'desc' => 'Enter the Gallery Post-ID with comma separated if you wish to display more than one post',
					'id'   => 'gal_postid',
					'std'  => '4',
					'class' => 'shortgallery gallery_postids',
					'type' => 'text'
				),	
				array(
					'name'	=> __('Gallery Limit', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Type the number of items you wish to display per page',
					'id' 	=> 'gal_limit',
					'class' => 'shortgallery  gallery_cat',
					'std' 	=> '4',
					'type'	=> 'text'
					),
				array(
					'name' 		=> __('Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple categories',
					'info' 		=> '(optional)',
					'id' 		=> 'gal_cat',
					'std' 		=> '',
					'class' 	=> 'shortgallery gallery_cat',
					'options' 	=> $this->atp_variable('gallery'),
					'type' 		=> 'multiselect'
					),
				array(
					'name'	=> __('Pagination', 'ATP_ADMIN_SITE'),
					'desc'	=> 'Check this if you wish to disable the pagination.',
					'id'	=> 'gal_pagination',
					'class' => 'shortgallery  gallery_cat',
					'std'	=> '',
					'type'	=> 'checkbox'
			),
		)
	),

	// V I D E O
	//--------------------------------------------------------
	'Video' => array(
			'name'    => __('Video', 'ATP_ADMIN_SITE'),
			'value'   => 'video',
			'options' => array(
			array(
					'name' 		=> __('Video Select', 'ATP_ADMIN_SITE'),
					'id' 		=> 'vid_select',
					'std' 		=> '',
					'type'		=> 'select',
					'options' 	=> array(
							'' 			 => 'Choose Type...',
							'video_cat' 		=> 'Video List',
							'video_postids'		=> 'Video ID'
					)
				),
		
			array(
					'name' 	=> __('Style', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Select the Video Columns Layout Style',
					'id' 	=> 'vid_column',
					'std'	=> '4',
					'class' => 'shortvideo video_cat',
					'options' => array(
						'3' 	=> '3 Columns',
						'4' 	=> '4 Columns'
					),
					'type' => 'select'
			),
			array(
					'name' => __('Video ID', 'ATP_ADMIN_SITE'),
					'desc' => 'Enter the Video Post-ID with comma separated if you wish to display more than one post',
					'id'   => 'vid_postid',
					'class' => 'shortvideo video_postids',
					'std'  => '4',
					'type' => 'text'
			),	
			
			array(
					'name' 		=> __('Category', 'ATP_ADMIN_SITE'),
					'desc' 		=> 'Hold Control/Command key to select multiple categories',
					'info' 		=> '(optional)',
					'class' 	=> 'shortvideo video_cat',
					'id' 		=> 'vid_cat',
					'std' 		=> '',
					'options' 	=> $this->atp_variable('video'),
					'type' 		=> 'multiselect'

			),
			array(
					'name' 	=> __('Video Limit', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Type the number of items you wish to display per page',
					'id' 	=> 'vid_limit',
					'class' => 'shortvideo  video_cat',
					'std' 	=> '4',
					'type' 	=> 'text'
			),
			array(
					'name' 	=> __('Pagination', 'ATP_ADMIN_SITE'),
					'desc' 	=> 'Check this if you wish to disable the pagination.',
					'id' 	=> 'vid_pagination',
					'class' => 'shortvideo  video_cat',
					'std' 	=> '',
					'type' 	=> 'checkbox'
			),
		)
	),

	// D J M I X
	//--------------------------------------------------------
	'Djmix' 	=> array(
		'name' 	=> __('Djmix', 'ATP_ADMIN_SITE'),
		'value' => 'djmix',
		'options' => array(

			array(
				'name' 		=> __('Djmix Select', 'ATP_ADMIN_SITE'),
				'id'   		=> 'djm_select',
				'std'		=> '',
				'type' 		=> 'select',
				'options'	=> array(
					'' 				=> 'Choose Type...',
					'djmix_cat' 	=> 'Djmix Category',
					'djmix_postids'	=> 'Djmix ID'
				)
			),

			array(
				'name' 		=> __('Style', 'ATP_ADMIN_SITE'),
				'desc' 		=> 'Select the DJmix Columns Layout Style',
				'id' 		=> 'djm_column',
				'std' 		=> '4',
				'class'		=> 'shortdjmix djmix_cat',
				'options'	=> array(
								'3'		=> '3 Columns',
								'4'		=> '4 Columns'
							),
				'type' => 'select'
			),	

			array(
				'name' 		=> __('Category', 'ATP_ADMIN_SITE'),
				'desc' 		=> 'Hold Control/Command key to select multiple categories',
				'info' 		=> '(optional)',
				'class'		=> 'shortdjmix djmix_cat',
				'id' 		=> 'djm_cat',
				'std' 		=> '',
				'options' 	=> $this->atp_variable('djmix'),
				'type' 		=> 'multiselect'
			),

			array(
				'name' => __('Djmix ID', 'ATP_ADMIN_SITE'),
				'desc' => 'Enter the DJmix Post-ID with comma separated if you wish to display more than one post',
				'id'   => 'djm_postid',
				'std'  => '4',
				'class'=> 'shortdjmix djmix_postids',
				'type' => 'text'
			),	
			
			array(
				'name'	=> __('Djmix Limit', 'ATP_ADMIN_SITE'),
				'desc' 	=> 'Type the number of items you wish to display per page',
				'id' 	=> 'djm_limit',
				'class'	=> 'shortdjmix djmix_cat',
				'std' 	=> '4',
				'type'	=> 'text'
			),
			
			array(
				'name'	=> __('Pagination', 'ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to disable the pagination.',
				'id'	=> 'djm_pagination',
				'class'	=> 'shortdjmix djmix_cat',
				'std'	=> '',
				'type'	=> 'checkbox'
			),
		)
	),

    // S O U N D C L O U D
    //--------------------------------------------------------
    'SoundCloud' => array(
        'name' => __('SoundCloud', 'ATP_ADMIN_SITE'),
        'value' => 'soundcloud',
        'options' => array(
            
            array(
                'name' => __('Sound Type', 'ATP_ADMIN_SITE'),
                'desc' => __('Select the audio type', 'ATP_ADMIN_SITE'),
                'id' => 'type',
                'std' => '',
                'options' => array(
                    'html5' => __('HTML5', 'ATP_ADMIN_SITE'),
                    'flash' => __('Flash', 'ATP_ADMIN_SITE')
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Width', 'ATP_ADMIN_SITE'),
                'desc' => __('Use px as units for width', 'ATP_ADMIN_SITE'),
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Height', 'ATP_ADMIN_SITE'),
                'desc' => __('Use px as units for height', 'ATP_ADMIN_SITE'),
                'id' => 'height',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Audio ID', 'ATP_ADMIN_SITE'),
                'desc' => __('Enter the ID only from the clips URL (e.g. http://api.soundcloud.com/tracks/<span style="color:red">123456789</span>)', 'ATP_ADMIN_SITE'),
                'id' => 'audio_id',
                'std' => '',
                'type' => 'text',
                'inputsize' => '30'
            ),
            array(
                'name' => __('Show Artwork', 'ATP_ADMIN_SITE'),
                'desc' => __('Check this if you wish to enable Artwork option.', 'ATP_ADMIN_SITE'),
                'id' => 'show_art',
                'std' => '',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Autoplay', 'ATP_ADMIN_SITE'),
                'desc' => __('Check this if you wish to enable auto play option.', 'ATP_ADMIN_SITE'),
                'id' => 'autoplay',
                'std' => '',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Color', 'ATP_ADMIN_SITE'),
                'desc' => __('Select the color for the playes', 'ATP_ADMIN_SITE'),
                'id' => 'color',
                'std' => '',
                'type' => 'color'
            )
        )
    ),
    // VIMEO 
    //--------------------------------------------------------
    'Vimeo' => array(
        'name' => __('Vimeo', 'ATP_ADMIN_SITE'),
        'value' => 'vimeo',
        'options' => array(
            array(
                'name' => __('Clip id', 'ATP_ADMIN_SITE'),
                'desc' => 'Enter the ID only from the clips URL (e.g. http://vimeo.com/<span style="color:red">123456<span style="color:red">)',
                'id' => 'clipid',
                'std' => '',
                
                'type' => 'textarea'
            ),
            array(
                'name' => __('Autoplay', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to enable auto play option.',
                'id' => 'autoplay',
                'std' => 'true',
                'type' => 'checkbox'
            )
        )
    ),
    //END - VIMEO
    // YOUTUBE 
    //--------------------------------------------------------
    'Youtube' => array(
        'name' => __('Youtube', 'ATP_ADMIN_SITE'),
        'value' => 'youtube',
        'options' => array(
            array(
                'name' => __('Clip id', 'ATP_ADMIN_SITE'),
                'desc' => 'The id from the clip URL after v= (e.g. http://www.youtube.com/watch?v=<span style="color:red">GgR6dyzkKHI</span>)',
                'id' => 'clipid',
                'std' => '',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Autoplay', 'ATP_ADMIN_SITE'),
                'desc' => 'Check this if you wish to start playing the video after the player intialized.',
                'id' => 'autoplay',
                'type' => 'checkbox'
            )
        )
    ),
    // E N D  - YOUTUBE 
    //--------------------------------
	 // RECENT POSTS
	//--------------------------------------------------------
	'Recent Posts' => array(
        'name'		=> __('Recent Posts','ATP_ADMIN_SITE'),
		'value'		=>'recentposts',
		'options'	=> array (
            array(
				'name'	=> __('Number of posts to show','ATP_ADMIN_SITE'),
				'desc'	=> __('Type the number of posts you wish to display.','ATP_ADMIN_SITE'),
				'id'	=> 'postlimit',
				'std'	=> '3',
				'type'	=> 'text',
				'inputsize'	=> '30'
			),
			array(
				'name'	=> __('Description Length','ATP_ADMIN_SITE'),
				'desc'	=> __('Length of Description to show','ATP_ADMIN_SITE'),
				'id'	=> 'description',
				'std'	=> '40',
				'type'	=> 'text',
				'inputsize'	=> '20'
			),
			
			array( 
				'name'	=> __('Categories','ATP_ADMIN_SITE'),
				'desc'	=> __('Select the categories to hold the posts','ATP_ADMIN_SITE'),
				'id'	=> 'cat_id',
				'std'	=> 'random',
				'type'	=> 'multiselect',
				'options' => $this->atp_variable('categories'),
				),

			array(
				'name'	=> __('Disaplay Post Thumbnail?','ATP_ADMIN_SITE'),
				'desc'	=> __('Check this if you wish to display the post thumbnail.','ATP_ADMIN_SITE'),
				'id'	=> 'thumb',
				'std'	=> '',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __('Display post date?','ATP_ADMIN_SITE'),
				'desc'	=> __('Check this if you wish to display the post date.','ATP_ADMIN_SITE'),
				'id'	=> 'postdate',
				'std'	=> '',
				'type'	=> 'checkbox',
			)
        )
    ),
	//END RECENT POSTS
	
	// POPULAR POSTS
	//--------------------------------------------------------
	'Popular Posts' => array(
		'name'		=> __('Popular Posts','ATP_ADMIN_SITE'),
		'value'		=>'popularposts',
		'options'	=> array (
			array(
				'name'	=> __('Number of posts to show','ATP_ADMIN_SITE'),
				'desc'	=> __('Type the number of posts you wish to display.','ATP_ADMIN_SITE'),
				'id'	=> 'limit',
				'std'	=> '3',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Description Length','ATP_ADMIN_SITE'),
				'desc'	=> __('Length of Description to show','ATP_ADMIN_SITE'),
				'id'	=> 'description',
				'std'	=> '40',
				'type'	=> 'text',
				'inputsize'	=> '20'
			),
			array(
				'name'	=> __('Thumbnail','ATP_ADMIN_SITE'),
				'desc'	=> __('Check this if you wish to display the post thumbnail.','ATP_ADMIN_SITE'),
				'id'	=> 'thumb',
				'std'	=> '',
				'type'	=> 'checkbox',
			),
			 array(
                'name' => __('Extra Information', 'ATP_ADMIN_SITE'),
                'desc' => '',
                'id' => 'popularselect',
                'std' => '',
                'type' => 'select',
                'options' => array(
                    'time'		 => 'Time',
                    'description'=> 'Description',
                )
            )
		)
	)
	// END POPULAR POSTS
    
);
?>
var shortcode = {
    init: function () {
        jQuery('.primary_select select').val('');
        jQuery('.primary_select select').change(function () {
            jQuery('.secondary_select').hide();
            if (this.value != '') {
                if (jQuery('#secondary_' + this.value).show().children('.tertiary_select').size() == 0) {
                    jQuery('#secondary_' + this.value).show();
                }
            }
        });
	

			
        jQuery('#sendtoeditor').click(function () {
            shortcode.sendToEditor();
        });

        jQuery('.secondaryselect select').val('');
        jQuery('.secondaryselect select').change(function () {
            jQuery(this).closest('.secondary_select').children('.tertiary_select').hide();
            if (this.value != '') {
                jQuery('#atp-' + this.value).show();
            }
        });
    },
    generate: function () {
        var type = jQuery('.primary_select select').val();
        switch (type) {
            // C O L U M N   L A Y O U T S 
            //--------------------------------------------------------
        case 'Columns':
            var types = jQuery('[name="Columns_type"]').val();
            if (types != '') {
                var content = jQuery('[name="Columns_content"]').val();
                return '\n[' + types + ']\n' + content + '\n[/' + types + ']\n';
            } else {
                return '';
            }
            break;

            // L A Y O U T S 
            //--------------------------------------------------------
        case 'Layouts':
            var secondary_type = jQuery('#secondary_Layouts select').val();
            switch (secondary_type) {
                //--------------------------------------------------------
            case 'one_half_layout':
                var one_half_layout = jQuery('[name="Layouts_one_half_layout_layout_1"]').val();
                var one_half_layout_last = jQuery('[name="Layouts_one_half_layout_layout_2"]').val();
                return '[one_half]' + one_half_layout + '[/one_half]\n[one_half_last]' + one_half_layout_last + '[/one_half_last]\n';
                break;
                //--------------------------------------------------------
            case 'one_third_layout':
                var one_third_layout1 = jQuery('[name="Layouts_one_third_layout_one_third_1"]').val();
                var one_third_layout2 = jQuery('[name="Layouts_one_third_layout_one_third_2"]').val();
                var one_third_layout3 = jQuery('[name="Layouts_one_third_layout_one_third_3"]').val();
                return '[one_third]' + one_third_layout1 + '[/one_third]\n[one_third]' + one_third_layout2 + '[/one_third]\n[one_third_last]' + one_third_layout3 + '[/one_third_last]\n';
                break;
                //--------------------------------------------------------
            case 'one_fourth_layout':
                var one_fourth_layout1 = jQuery('[name="Layouts_one_fourth_layout_one_fourth_1"]').val();
                var one_fourth_layout2 = jQuery('[name="Layouts_one_fourth_layout_one_fourth_2"]').val();
                var one_fourth_layout3 = jQuery('[name="Layouts_one_fourth_layout_one_fourth_3"]').val();
                var one_fourth_layout4 = jQuery('[name="Layouts_one_fourth_layout_one_fourth_4"]').val();
                return '[one_fourth]' + one_fourth_layout1 + '[/one_fourth]\n[one_fourth]' + one_fourth_layout2 + '[/one_fourth]\n[one_fourth]' + one_fourth_layout3 + '[/one_fourth]\n[one_fourth_last]' + one_fourth_layout4 + '[/one_fourth_last]\n';
                break;
                //--------------------------------------------------------
            case 'one5thlayout':
                var one5thlayout1 = jQuery('[name="Layouts_one5thlayout_one5thlayout1"]').val();
                var one5thlayout2 = jQuery('[name="Layouts_one5thlayout_one5thlayout2"]').val();
                var one5thlayout3 = jQuery('[name="Layouts_one5thlayout_one5thlayout3"]').val();
                var one5thlayout4 = jQuery('[name="Layouts_one5thlayout_one5thlayout4"]').val();
                var one5thlayout5 = jQuery('[name="Layouts_one5thlayout_one5thlayout5"]').val();
                return '[one_fifth]' + one5thlayout1 + '[/one_fifth]\n[one_fifth]' + one5thlayout2 + '[/one_fifth]\n[one_fifth]' + one5thlayout3 + '[/one_fifth]\n[one_fifth]' + one5thlayout4 + '[/one_fifth]\n[one_fifth_last]' + one5thlayout5 + '[/one_fifth_last]\n';
                break;
                //--------------------------------------------------------
            case 'one6thlayout':
                var one6thlayout1 = jQuery('[name="Layouts_one6thlayout_one6thlayout1"]').val();
                var one6thlayout2 = jQuery('[name="Layouts_one6thlayout_one6thlayout2"]').val();
                var one6thlayout3 = jQuery('[name="Layouts_one6thlayout_one6thlayout3"]').val();
                var one6thlayout4 = jQuery('[name="Layouts_one6thlayout_one6thlayout4"]').val();
                var one6thlayout5 = jQuery('[name="Layouts_one6thlayout_one6thlayout5"]').val();
                var one6thlayout6 = jQuery('[name="Layouts_one6thlayout_one6thlayout6"]').val();
                return '[one_sixth]' + one6thlayout1 + '[/one_sixth]\n[one_sixth]' + one6thlayout2 + '[/one_sixth]\n[one_sixth]' + one6thlayout3 + '[/one_sixth]\n[one_sixth]' + one6thlayout4 + '[/one_sixth]\n[one_sixth]' + one6thlayout5 + '[/one_sixth]\n[one_sixth_last]' + one6thlayout6 + '[/one_sixth_last]\n';
                break;
                //--------------------------------------------------------
            case 'one_3rd_2rd':
                var one3rd2rd_1 = jQuery('[name="Layouts_one_3rd_2rd_one3rd2rd_1"]').val();
                var one3rd2rd_2 = jQuery('[name="Layouts_one_3rd_2rd_one3rd2rd_2"]').val();
                return '[one_third]' + one3rd2rd_1 + '[/one_third]\n[two_third_last]' + one3rd2rd_2 + '[/two_third_last]\n';
                break;
                //--------------------------------------------------------
            case 'two_3rd_1rd':
                var two3rd1rd_1 = jQuery('[name="Layouts_two_3rd_1rd_two3rd1rd_1"]').val();
                var two3rd1rd_2 = jQuery('[name="Layouts_two_3rd_1rd_one3rd2rd_2"]').val();
                return '[two_third]' + two3rd1rd_1 + '[/two_third]\n[one_third_last]' + two3rd1rd_2 + '[/one_third_last]\n';
                break;
                //--------------------------------------------------------
            case 'One_4th_Three_4th':
                var One4thThree4th_1 = jQuery('[name="Layouts_One_4th_Three_4th_One4thThree4th_1"]').val();
                var One4thThree4th_2 = jQuery('[name="Layouts_One_4th_Three_4th_One4thThree4th_2"]').val();
                return '[one_fourth]' + One4thThree4th_1 + '[/one_fourth]\n[three_fourth_last]' + One4thThree4th_2 + '[/three_fourth_last]\n';
                break;
                //--------------------------------------------------------
            case 'Three_4th_One_4th':
                var Three4thOne4th_1 = jQuery('[name="Layouts_Three_4th_One_4th_Three4thOne4th_1"]').val();
                var Three4thOne4th_2 = jQuery('[name="Layouts_Three_4th_One_4th_Three4thOne4th_2"]').val();
                return '[three_fourth]' + Three4thOne4th_1 + '[/three_fourth]\n[one_fourth_last]' + Three4thOne4th_2 + '[/one_fourth_last]\n';
                break;
                //--------------------------------------------------------
            case 'One_4th_One_4th_One_half':
                var One_4th_One_4th_One_half_1 = jQuery('[name="Layouts_One_4th_One_4th_One_half_One4thOne4thOnehalf_1"]').val();
                var One_4th_One_4th_One_half_2 = jQuery('[name="Layouts_One_4th_One_4th_One_half_One4thOne4thOnehalf_2"]').val();
                var One_4th_One_4th_One_half_3 = jQuery('[name="Layouts_One_4th_One_4th_One_half_One4thOne4thOnehalf_3"]').val();
                return '[one_fourth]' + One_4th_One_4th_One_half_1 + '[/one_fourth]\n[one_fourth]' + One_4th_One_4th_One_half_2 + '[/one_fourth]\n[one_half_last]' + One_4th_One_4th_One_half_3 + '[/one_half_last]\n';
                break;
                //--------------------------------------------------------
            case 'One_half_One_4th_One_4th':
                var OnehalfOne4thOne4th_1 = jQuery('[name="Layouts_One_half_One_4th_One_4th_OnehalfOne4thOne4th_1"]').val();
                var OnehalfOne4thOne4th_2 = jQuery('[name="Layouts_One_half_One_4th_One_4th_OnehalfOne4thOne4th_2"]').val();
                var OnehalfOne4thOne4th_3 = jQuery('[name="Layouts_One_half_One_4th_One_4th_OnehalfOne4thOne4th_3"]').val();
                return '[one_half]' + OnehalfOne4thOne4th_1 + '[/one_half]\n[one_fourth]' + OnehalfOne4thOne4th_2 + '[/one_fourth]\n[one_fourth_last]' + OnehalfOne4thOne4th_3 + '[/one_fourth_last]\n';
                break;
                //--------------------------------------------------------		
            case 'One_4th_One_half_One_4th':
                var One4thOnehalfOne4th_1 = jQuery('[name="Layouts_One_4th_One_half_One_4th_One4thOnehalfOne4th_1"]').val();
                var One4thOnehalfOne4th_2 = jQuery('[name="Layouts_One_4th_One_half_One_4th_One4thOnehalfOne4th_2"]').val();
                var One4thOnehalfOne4th_3 = jQuery('[name="Layouts_One_4th_One_half_One_4th_One4thOnehalfOne4th_3"]').val();
                return '[one_fourth]' + One4thOnehalfOne4th_1 + '[/one_fourth]\n[one_half]' + One4thOnehalfOne4th_2 + '[/one_half]\n[one_fourth_last]' + One4thOnehalfOne4th_3 + '[/one_fourth_last]\n';
                break;
                //--------------------------------------------------------
            case 'One_5th_Four_5th':
                var One5thFour5th_1 = jQuery('[name="Layouts_One_5th_Four_5th_One5thFour5th_1"]').val();
                var One5thFour5th_2 = jQuery('[name="Layouts_One_5th_Four_5th_One5thFour5th_2"]').val();
                return '[one_fifth]' + One5thFour5th_1 + '[/one_fifth]\n[four_fifth_last]' + One5thFour5th_2 + '[/four_fifth_last]\n';
                break;
                //--------------------------------------------------------
            case 'Four_5th_One_5th':
                var Four5thOne5th_1 = jQuery('[name="Layouts_Four_5th_One_5th_Four5thOne5th_1"]').val();
                var Four5thOne5th_2 = jQuery('[name="Layouts_Four_5th_One_5th_Four5thOne5th_2"]').val();
                return '[four_fifth]' + Four5thOne5th_1 + '[/four_fifth]\n[one_fifth_last]' + Four5thOne5th_2 + '[/one_fifth_last]\n';
                break;
                //--------------------------------------------------------
            case 'Two_5th_Three_5th':
                var Two5thThree5th_1 = jQuery('[name="Layouts_Two_5th_Three_5th_Two5thThree5th_1"]').val();
                var Two5thThree5th_2 = jQuery('[name="Layouts_Two_5th_Three_5th_Two5thThree5th_2"]').val();
                return '[two_fifth]' + Two5thThree5th_1 + '[/two_fifth]\n[three_fifth_last]' + Two5thThree5th_2 + '[/three_fifth_last]\n';
                break;
                //--------------------------------------------------------
            case 'Three_5th_Two_5th':
                var Three5thTwo5th_1 = jQuery('[name="Layouts_Three_5th_Two_5th_Three5thTwo5th_1"]').val();
                var Three5thTwo5th_2 = jQuery('[name="Layouts_Three_5th_Two_5th_Three5thTwo5th_2"]').val();
                return '[three_fifth]' + Three5thTwo5th_1 + '[/three_fifth]\n[two_fifth_last]' + Three5thTwo5th_2 + '[/two_fifth_last]\n';
                break;
            }
            break;

            // D R O P C A P 
            //--------------------------------------------------------
        case 'dropcap1':
			var animation = jQuery('[name="dropcap1_animation"]').val();
            var text = jQuery('[name="dropcap1_dropcap_text"]').val();
            var color = jQuery('[name="dropcap1_color"]').val();
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}	
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            return '[dropcap1' + color + animation + ']' + text + '[/dropcap1]';
            break;
            // D R O P C A P   2
            //--------------------------------------------------------
        case 'dropcap2':
			var animation = jQuery('[name="dropcap2_animation"]').val();
            var text = jQuery('[name="dropcap2_dropcap_text"]').val();
            var bgcolor = jQuery('[name="dropcap2_bgcolor"]').val();
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}			
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            return '[dropcap2' + bgcolor + animation + ']' + text + '[/dropcap2]';
            break;
            // D R O P C A P   3
            //--------------------------------------------------------
        case 'dropcap3':
			var animation = jQuery('[name="dropcap3_animation"]').val();
            var text = jQuery('[name="dropcap3_dropcap_text"]').val();
            var color = jQuery('[name="dropcap3_color"]').val();
            if (color !== '') {
                color = ' color="' + color + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
            return '[dropcap3' + color + animation + ']' + text + '[/dropcap3]';
            break;
            // G O O G L E   F O N T
            //--------------------------------------------------------
        case 'googlefont':
			var animation = jQuery('[name="googlefont_animation"]').val();
			var font = jQuery('[name="googlefont_font"]').val();
            var font = jQuery('[name="googlefont_font"]').val();
            var size = jQuery('[name="googlefont_size"]').val();
            var margin = jQuery('[name="googlefont_margin"]').val();
            var text = jQuery('[name="googlefont_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (font !== '') {
                font = ' font="' + font + '"';
            }
            if (size !== '') {
                size = ' size="' + size + '"';
            }
            if (margin !== '') {
                margin = ' margin="' + margin + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}			

            return '[googlefont' + font + size + margin + animation + ']' + text + '[/googlefont]';
            break;
            // H I G H L I G H T 
            //--------------------------------------------------------
        case 'highlight':
            var textcolor = jQuery('[name="highlight_textcolor"]').val();
            var bgcolor = jQuery('[name="highlight_bgcolor"]').val();
            var text = jQuery('[name="highlight_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            if (textcolor !== '') {
                textcolor = ' textcolor="' + textcolor + '"';
            }

            return '\n[highlight' + bgcolor + textcolor + ']' + text + '[/highlight]\n';
            break;
            // H I G H L I G H T
            //--------------------------------------------------------
        case 'highlight2':
            var textcolor = jQuery('[name="highlight2_textcolor"]').val();
            var text = jQuery('[name="highlight2_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (textcolor !== '') {
                textcolor = ' textcolor="' + textcolor + '"';
            }

            return '[highlight2' + textcolor + ']' + text + '[/highlight2]';
            break;
            // F A N C Y   H E A D I N G 
            //--------------------------------------------------------
        case 'fancyheading':
            var textcolor = jQuery('[name="fancyheading_textcolor"]').val();
            var bgcolor = jQuery('[name="fancyheading_bgcolor"]').val();
            var heading = jQuery('[name="fancyheading_heading"]').val();
            var align = jQuery('[name="fancyheading_align"]').val();
            var text = jQuery('[name="fancyheading_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (textcolor !== '') {
                textcolor = ' textcolor="' + textcolor + '"';
            }
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            if (heading !== '') {
                heading = ' heading="' + heading + '"';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }

            return '\n[fancyheading' + textcolor + heading + bgcolor + align + ']' + text + '[/fancyheading]\n';
            break;

            // Section Row
            //--------------------------------------------------------
        case 'section':
            var textcolor = jQuery('[name="section_textcolor"]').val();
            var bgimage = jQuery('[name="section_bgimage"]').val();
            var bgcolor = jQuery('[name="section_bgcolor"]').val();
            var text = jQuery('[name="section_text"]').val();
            var padding = jQuery('[name="section_padding"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            if (bgimage !== '') {
                bgimage = ' image="' + bgimage + '"';
            }
            if (textcolor !== '') {
                textcolor = ' textcolor="' + textcolor + '"';
            }
            if (padding !== '') {
                padding = ' padding="' + padding + '"';
            }

            return '\n[section' + bgcolor + textcolor + padding + bgimage + ']' + text + '[/section]\n';
            break;

            // B L O C K Q U O T E 
            //--------------------------------------------------------
        case 'blockquote':
            var align = jQuery('[name="blockquote_align"]').val();
            var animation = jQuery('[name="blockquote_animation"]').val();
            var cite = jQuery('[name="blockquote_cite"]').val();
            var citelink = jQuery('[name="blockquote_citelink"]').val();
            var content = jQuery('[name="blockquote_content"]').val();
            var width = jQuery('[name="blockquote_width"]').val();
            if (animation !== '') {
                animation = ' animation="' + animation + '"';
            }
            if (content !== '') {
                content = '' + content + '';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (cite !== '') {
                cite = ' cite="' + cite + '"';
            }
            if (citelink !== '') {
                citelink = ' citelink="' + citelink + '"';
            }
            if (width !== '') {
                width = ' width="' + width + '"';
            }

            return '[blockquote' + align + width + cite + citelink + animation + ']' + content + '[/blockquote]\n';
            break;

			// C U S T O M   A N I M A T I O N
            //--------------------------------------------------------
        case 'custom_animation':
            var animation = jQuery('[name="custom_animation_animation"]').val();
            var content = jQuery('[name="custom_animation_content"]').val();
            if (animation !== '') {
                animation = ' animation="' + animation + '"';
            }
            if (content !== '') {
                content = '' + content + '';
            }
            
            return '[custom_animation' + animation + ']' + content + '[/custom_animation]\n';
            break;


            // S T Y L E D   L I S T S 
            //--------------------------------------------------------
        case 'styledlist':
            var style = jQuery('[name="styledlist_style"]').val();
            var color = jQuery('[name="styledlist_color"]').val();
            var content = jQuery('[name="styledlist_content"]').val();
            if (content !== '') {
                content = '' + content + '';
            }
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }

            return '\n[list' + style + color + ']\n' + content + '\n[/list]\n';
            break;

            // F O N T  A W E S O M E  I C O N S
            //--------------------------------------------------------
        case 'icons':
            var title = jQuery('[name="icons_title"]').val();
            var style = jQuery('[name="icons_style"]').val();
            var size = jQuery('[name="icons_size"]').val();
            var color = jQuery('[name="icons_color"]').val();
            if (size !== '') {
                size = '  size="' + size + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            if (title !== '') {
                title = ' title="' + title + '"';
            }

            return '\n[icons' + size + color + title + animation +  ']\n';
            break;
            // F A N C Y   A M P E R S A N D
            //--------------------------------------------------------
        case 'fancy_ampersand':
            var size = jQuery('[name="fancy_ampersand_size"]').val();
            var color = jQuery('[name="fancy_ampersand_color"]').val();
            if (size !== '') {
                size = ' size="' + size + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }

            return '[fancy_ampersand' + size + color + ']';
            break;

            // I C O N S 
            //--------------------------------------------------------
        case 'icon':
			var animation = jQuery('[name="icon_animation"]').val();
            var icon = jQuery('[name="icon_icon"]').val();
            var style = jQuery('[name="icon_style"]').val();
            var size = jQuery('[name="icon_size"]').val();
            var color = jQuery('[name="icon_color"]').val();
            var bgcolor = jQuery('[name="icon_bgcolor"]').val();
            var bordercolor = jQuery('[name="icon_bordercolor"]').val();
			var align = jQuery('[name="icon_align"]').val();
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (size !== '') {
                size = '  size="' + size + '"';
            }
            if (icon !== '') {
                icon = '  icon="' + icon + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            if (title !== '') {
                title = ' title="' + title + '"';
            }
            if (bgcolor !== '') {
                bgcolor = '  bgcolor="' + bgcolor + '"';
            }
            if (bordercolor !== '') {
                bordercolor = '  bordercolor="' + bordercolor + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}		

            return '\n[icons' + style + size + color + bgcolor + icon + bordercolor + animation + align + ']\n';
            break;

            // I C O N   L I N K S
            //--------------------------------------------------------
        case 'iconlinks':
            var style = jQuery('[name="iconlinks_style"]').val();
            var color = jQuery('[name="iconlinks_color"]').val();
            var href = jQuery('[name="iconlinks_href"]').val();
            var target = jQuery('[name="iconlinks_target"]').val();
            var text = jQuery('[name="iconlinks_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            if (href !== '') {
                href = ' href="' + href + '"';
            }
            if (target !== '') {
                target = ' target="' + target + '"';
            }

            return '\n[icon' + style + color + href + target + ']' + text + '[/icon]\n';
            break;
            // B U T T O N  
            //--------------------------------------------------------
        case 'Button':
			var animation = jQuery('[name="Button_animation"]').val();
            var id = jQuery('[name="Button_id"]').val();
            var subclass = jQuery('[name="Button_subclass"]').val();
            var link = jQuery('[name="Button_link"]').val();
			var icon = jQuery('[name="Button_icon"]').val();
            var linktarget = jQuery('[name="Button_linktarget"]').val();
            var color = jQuery('[name="Button_color"]').val();
            var align = jQuery('[name="Button_align"]').val();
            var bgcolor = jQuery('[name="Button_bgcolor"]').val();
            var hoverbgcolor = jQuery('[name="Button_hoverbgcolor"]').val();
            var hovertextcolor = jQuery('[name="Button_hovertextcolor"]').val();
            var textcolor = jQuery('[name="Button_textcolor"]').val();
            var size = jQuery('[name="Button_size"]').val();
            var style = jQuery('[name="Button_border"]').val();
            var width = jQuery('[name="Button_width"]').val();
            var fullwidth = jQuery('[name="Button_fullwidth"]');
            var lightbox = jQuery('[name="Button_lightbox"]');
            if (fullwidth.is('.atp-button')) {
                if (fullwidth.is(':checked')) {
                    fullwidth = ' fullwidth="true"';
                } else {
                    fullwidth = ' fullwidth="false"';
                }
            }
            if (lightbox.is('.atp-button')) {
                if (lightbox.is(':checked')) {
                    lightbox = ' lightbox="true"';
                } else {
                    lightbox = '';
                }
            }
            var text = jQuery('[name="Button_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (id !== '') {
                id = ' id="' + id + '"';
            }
            if (subclass !== '') {
                subclass = ' class="' + subclass + '"';
            }
            if (link !== '') {
                link = ' link="' + link + '"';
            }
            if (linktarget !== '') {
                linktarget = ' linktarget="' + linktarget + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            if (hoverbgcolor !== '') {
                hoverbgcolor = ' hoverbgcolor="' + hoverbgcolor + '"';
            }
            if (hovertextcolor !== '') {
                hovertextcolor = ' hovertextcolor="' + hovertextcolor + '"';
            }
            if (textcolor !== '') {
                textcolor = ' textcolor="' + textcolor + '"';
            }
            if (size !== '') {
                size = ' size="' + size + '"';
            }
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (width !== '') {
                width = ' width="' + width + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
			if (icon !== '') {
				icon = ' icon="' + icon + '"';
			}

            return '[button' + animation + id + subclass + link + icon +linktarget + color + align + bgcolor + hoverbgcolor + hovertextcolor + textcolor + size + style + width + fullwidth + lightbox + ']' + text + '[/button]';
            break;
            // D I V I D E R S 
            //--------------------------------------------------------
        case 'divider':
            var shortcodesub_type = jQuery('#secondary_divider select').val();
            if (shortcodesub_type == 'custom_divider') {
                var img = jQuery("[name=divider_custom_divider_dividerimg]").val();
                if (img != '') {
                    img = ' img="' + img + '"';
                } else {
                    img = '';
                }

                return '\n[custom_divider' + img + ']\n';
            } else if (shortcodesub_type == 'demo_space') {
                var height = jQuery("[name=divider_demo_space_height]").val();
                if (height != '') {
                    height = ' height="' + height + '"';
                } else {
                    height = '';
                }

                return '\n[demo_space' + height + ']\n';
            } else if (shortcodesub_type == 'divider') {
                var margin = jQuery("[name=divider_divider_margin]").val();
                var dividertype = jQuery('[name="divider_divider_dividertype"]').val();
                var bordercolor = jQuery('[name="divider_divider_bordercolor"]').val();
                if (margin != '') {
                    margin = ' margin="' + margin + '"';
                } else {
                    margin = '';
                }
                if (bordercolor != '') {
                    bordercolor = ' bordercolor="' + bordercolor + '"';
                }
                if (dividertype !== '') {
                    dividertype = ' style="' + dividertype + '"';
                }

                return '\n[divider' + dividertype + margin + bordercolor + ']\n';
            } else {

                return '\n[' + jQuery('#secondary_divider select').val() + ']\n';
            }
            break;
            // Toggle
            //--------------------------------------------------------
        case 'toggle':
			var animation = jQuery('[name="toggle_animation"]').val();
            var heading = jQuery('[name="toggle_heading"]').val();
            var text = jQuery('[name="toggle_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (heading !== '') {
                heading = ' heading="' + heading + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}

            return '\n[toggle' + animation + heading + ']\n' + text + '\n[/toggle]\n';
            break;
            // B O X E S  
            //--------------------------------------------------------
        case 'Boxes':
            var shortcodesub_type = jQuery('#secondary_Boxes select').val();
            switch (shortcodesub_type) {
                // F R A M E D   B O X
                //--------------------------------------------------------
            case 'framebox':
				var animation = jQuery('[name="Boxes_framebox_animation"]').val();
                var boxbgcolor = jQuery('[name="Boxes_framebox_boxbgcolor"]').val();
                var bordercolor = jQuery('[name="Boxes_framebox_bordercolor"]').val();
                var textcolor = jQuery('[name="Boxes_framebox_textcolor"]').val();
                var text = jQuery('[name="Boxes_framebox_text"]').val();
                if (text !== '') {
                    text = '' + text + '';
                }
                if (boxbgcolor !== '') {
                    boxbgcolor = ' bgcolor="' + boxbgcolor + '"';
                }
                if (textcolor !== '') {
                    textcolor = ' textcolor="' + textcolor + '"';
                }
                if (bordercolor !== '') {
                    bordercolor = ' bordercolor="' + bordercolor + '"';
                }
				if (animation !== '') {
					animation = ' animation="' + animation + '"';
				}
                return '\n[frame_box' + animation + boxbgcolor + bordercolor + textcolor + ']\n' + text + '\n[/frame_box]\n';
                break;
                // F A N C Y B O X 
                //--------------------------------------------------------
            case 'fancybox':
				var animation = jQuery('[name="Boxes_fancybox_animation"]').val();
                var title = jQuery('[name="Boxes_fancybox_title"]').val();
                var titlebgcolor = jQuery('[name="Boxes_fancybox_titlebgcolor"]').val();
                var titlecolor = jQuery('[name="Boxes_fancybox_titlecolor"]').val();
                var textcolor = jQuery('[name="Boxes_fancybox_textcolor"]').val();
                var boxbgcolor = jQuery('[name="Boxes_fancybox_boxbgcolor"]').val();
                var ribbon = jQuery('[name="Boxes_fancybox_ribbon"]').val();
                var text = jQuery('[name="Boxes_fancybox_text"]').val();
                if (text !== '') {
                    text = '' + text + '';
                }
                if (title !== '') {
                    title = ' title="' + title + '"';
                }
                if (titlebgcolor !== '') {
                    titlebgcolor = ' titlebgcolor="' + titlebgcolor + '"';
                }
                if (titlecolor !== '') {
                    titlecolor = ' titlecolor="' + titlecolor + '"';
                }
                if (textcolor !== '') {
                    textcolor = ' textcolor="' + textcolor + '"';
                }
                if (boxbgcolor !== '') {
                    boxbgcolor = ' boxbgcolor="' + boxbgcolor + '"';
                }
                if (ribbon !== '') {
                    ribbon = ' ribbon="' + ribbon + '"';
                }
				if (animation !== '') {
					animation = ' animation="' + animation + '"';
				}
                return '\n[fancy_box' + animation + title + titlebgcolor + titlecolor + textcolor + boxbgcolor + ribbon + ']' + text + '[/fancy_box]\n';
                break;
                // T E A S E R   B O X 
                //--------------------------------------------------------
            case 'teaserbox':
				var animation = jQuery('[name="Boxes_teaserbox_animation"]').val();
                var bgcolor = jQuery('[name="Boxes_teaserbox_bgcolor"]').val();
                var buttonlink = jQuery('[name="Boxes_teaserbox_buttonlink"]').val();
                var linktarget = jQuery('[name="Boxes_teaserbox_linktarget"]').val();
                var color = jQuery('[name="Boxes_teaserbox_color"]').val();
                var buttonsize = jQuery('[name="Boxes_teaserbox_buttonsize"]').val();
                var buttontext = jQuery('[name="Boxes_teaserbox_buttontext"]').val();
                var style = jQuery('[name="Boxes_teaserbox_border"]').val();
                var text = jQuery('[name="Boxes_teaserbox_text"]').val();

                if (buttonlink !== '') {
                    buttonlink = ' buttonlink="' + buttonlink + '"';
                }
                if (linktarget !== '') {
                    linktarget = ' linktarget="' + linktarget + '"';
                }
                if (color !== '') {
                    color = ' color="' + color + '"';
                }
                if (buttontext !== '') {
                    buttontext = ' buttontext="' + buttontext + '"';
                }
                if (bgcolor !== '') {
                    bgcolor = ' bgcolor="' + bgcolor + '"';
                }
                if (buttonsize !== '') {
                    buttonsize = ' buttonsize="' + buttonsize + '"';
                }
                if (style !== '') {
                    style = ' style="' + style + '"';
                }

                if (text !== '') {
                    text = '' + text + '';
                }
				if (animation !== '') {
					animation = ' animation="' + animation + '"';
				}
                return '\n[callout' + animation + bgcolor + buttonlink + linktarget + color + buttontext + buttonsize + style + ']' + text + '[/callout]\n';
                break;

            }
            break;
            // M E S S A G E   B O X 
            //--------------------------------------------------------
        case 'messagebox':
			var animation = jQuery('[name="messagebox_animation"]').val();
            var msgtype = jQuery('[name="messagebox_msgtype"]').val();
            var text = jQuery('[name="messagebox_text"]').val();
            var closebox = jQuery('[name="messagebox_close"]');
            if (closebox.is('.atp-button')) {
                if (closebox.is(':checked')) {
                    closebox = ' close="true"';
                } else {
                    closebox = '';
                }
            }
            if (text !== '') {
                text = '' + text + '';
            }
            if (msgtype == '') {
                msgtype = 'info';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
			
            return '\n[' +  msgtype + closebox + animation + ']\n' + text + '\n[/' + msgtype + ']\n';
            break;
            // N O T E   B O X 
            //--------------------------------------------------------
        case 'notebox':
			var animation = jQuery('[name="notebox_animation"]').val();			
            var align = jQuery('[name="notebox_align"]').val();
            var width = jQuery('[name="notebox_width"]').val();
            var title = jQuery('[name="notebox_title"]').val();
            var text = jQuery('[name="notebox_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (width !== '') {
                width = ' width="' + width + '"';
            }
            if (title !== '') {
                title = ' title="' + title + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}			
            return '\n[note' + animation + align + width + title + ']' + text + '[/note]\n';
            break;
            // T A B S 
            //--------------------------------------------------------
        case 'tabs':
            var tabcount = jQuery('[name="tabs_tab"]').val();
            var stabstype = jQuery('[name="tabs_ctabs"]').val();
			var animation = jQuery('[name="tabs_animation"]').val();
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
            }
            var outputs = '[tabs ' + stabstype + animation + ']\n';
            for (var i = 1; i <= tabcount; i++) {

                outputs += '[tab title="Title Here" tabcolor="" textcolor=""]Content Here[/tab]\n';
            }
            outputs += '[/tabs]';

            return outputs;
            break;
            // A C C O R D I O N 
            //--------------------------------------------------------
        case 'accordion':
            var ac_count = jQuery('[name="accordion_accordion_col"]').val();
            var animation = jQuery('[name="accordion_animation"]').val();
            if (animation !== '') {
                animation = ' animation="' + animation + '"';
            }
            var outputs = '[accordion-wrap ' + animation + ']\n';
            for (var i = 1; i <= ac_count; i++) {
                outputs += '[accordion title="Title Here" icon="icon-file" active="false"]Content Here[/accordion]\n';
            }
            outputs += '[/accordion-wrap]';

            return outputs;
            break;
            // 	P R I C I N G  T A B L E
            //--------------------------------------------------------
        case 'pricing':
            var pt = jQuery('[name="pricing_price"]').val();
			var animation = jQuery('[name="pricing_animation"]').val();
			 if (animation !== '') {
					animation = ' animation="' + animation + '"';
				 }				
            var outputs = '[pricingcolumns ' + animation + ']\n';
            for (var i = 1; i <= pt; i++) {

                outputs += '[col title="Title Here" headingbgcolor=""  headingcolor="" price="" ]Content Here[/col]\n';
            }
            outputs += '[/pricingcolumns]';

            return outputs;
            break;
           // I M A G E 
            //-------------------------------------------------------------
        case 'image':
			var animation = jQuery('[name="image_animation"]').val();
            var title = jQuery('[name="image_title"]').val();
            var caption = jQuery('[name="image_caption"]').val();
            var lightbox = jQuery('[name="image_lightbox"]');
            var width = jQuery('[name="image_width"]').val();
            var height = jQuery('[name="image_height"]').val();
            var align = jQuery('[name="image_align"]').val();
            var alink = jQuery('[name="image_alink"]').val();
            var imgclass = jQuery('[name="image_class"]').val();
            var target = jQuery('[name="image_target"]').val();
            var imagesrc = jQuery('[name="image_imagesrc"]').val();
            if (imagesrc != '') {
                imagesrc = ' src="' + imagesrc + '"';
            }
            if (width != '') {
                width = ' width="' + width + '"';
            } else {
                width = ' width="200"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            } else {
                height = ' height="200"';
            }
            if (title != '') {
                title = ' title="' + title + '"';
            }
            if (caption != '') {
                caption = ' caption="' + caption + '"';
            }
            if (alink != '') {
                alink = ' link="' + alink + '"';
            }
            if (target != '') {
                target = ' target="' + target + '"';
            }
            if (imgclass != '') {
                imgclass = ' class="' + imgclass + '"';
            }
            if (align != '') {
                align = ' align="' + align + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
            if (lightbox.is('.atp-button')) {
                if (lightbox.is(':checked')) {
                    lightbox = ' lightbox="true"';
                } else {
                    lightbox = ' lightbox="false"';
                }
            }

            return '\n[image' + width + height + title + caption + lightbox + align + alink + target + imagesrc + imgclass + animation + ']\n';
            break;
            // P H O T O F R A M E 
            //---------------------------------------------------------------------------
        case 'photoframe':
            var imagesrc = jQuery('[name="photoframe_imagesrc"]').val();
            var alt = jQuery('[name="photoframe_alt"]').val();
            var width = jQuery('[name="photoframe_width"]').val();
            var height = jQuery('[name="photoframe_height"]').val();
            if (imagesrc != '') {
                imagesrc = ' src="' + imagesrc + '"';
            }
            if (width != '') {
                width = ' width="' + width + '"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            }
            if (alt != '') {
                alt = ' alt="' + alt + '"';
            }
            if (alink != '') {
                link = ' link="' + alink + '"';
            }

            return '\n[photoframe' + imagesrc + width + height + alt + ']\n';
            break;
            // G O O G L E   M A P 
        case 'gmap':
            var width = jQuery('[name="gmap_width"]').val();
            var height = jQuery('[name="gmap_height"]').val();
            var address = jQuery('[name="gmap_address"]').val();
            var latitude = jQuery('[name="gmap_latitude"]').val();
            var longitude = jQuery('[name="gmap_longitude"]').val();
            var stylerscolor = jQuery('[name="gmap_stylerscolor"]').val();
            var zoom = jQuery('[name="gmap_zoom"]').val();
            var marker_desc = jQuery('[name="gmap_marker_desc"]').val();
            var popup = jQuery('[name="gmap_infowindow"]');
            var maptype = jQuery('[name="gmap_types"]').val();
            var controller = jQuery('[name="gmap_controller"]');
            if (popup.is('.atp-button')) {
                if (popup.is(':checked')) {
                    popup = ' infowindow="true"';
                } else {
                    popup = ' infowindow="false"';
                }
            }
            if (controller.is('.atp-button')) {
                if (controller.is(':checked')) {
                    controller = ' controller="true"';
                } else {
                    controller = ' controller="false"';
                }
            }
            if (width != '') {
                width = ' width="' + width + '"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            }
            if (address != '') {
                address = ' address="' + address + '"';
            }
            if (latitude != '') {
                latitude = ' latitude="' + latitude + '"';
            }
            if (longitude != '') {
                longitude = ' longitude="' + longitude + '"';
            }
            if (stylerscolor != '') {
                stylerscolor = ' color="' + stylerscolor + '"';
            }

            if (content != '') {
                html = ' html="' + marker_desc + '"';
            }
            if (zoom != '') {
                zoom = ' zoom="' + zoom + '"';
            }
            if (maptype != '') {
                maptype = ' maptype="' + maptype + '"';
            }

            return '[gmap' + width + height + latitude + longitude + address + zoom + html + popup + controller + maptype + stylerscolor + ']';
            break;
            // T W I T T E R
            //--------------------------------------------------------
        case 'twitter':
			var animation = jQuery('[name="twitter_animation"]').val();
            var username = jQuery('[name="twitter_username"]').val();
            var limit = jQuery('[name="twitter_limit"]').val();
              if (username != '') {
                username = ' username="' + username + '"';
            }
             if (limit != '') {
                limit = ' limit="' + limit + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
            return '\n[twitter' + animation + username + limit + ']\n';
            break;
            // F L I C K R 
            //--------------------------------------------------------
        case 'flickr':
            var id = jQuery('[name="flickr_id"]').val();
            var limit = jQuery('[name="flickr_limit"]').val();
            var type = jQuery('[name="flickr_type"]').val();
            var display = jQuery('[name="flickr_display"]').val();
            if (id != '') {
                id = ' id="' + id + '"';
            }
            if (limit != '') {
                limit = ' limit="' + limit + '"';
            }
            if (type != '') {
                type = ' type="' + type + '"';
            }
            if (display != '') {
                display = ' display="' + display + '"';
            }

            return '\n[flickr' + id + limit + display + type + ']\n';
            break;
  
            // C O N T A C T   I N F O 
            //--------------------------------------------------------
        case 'contactinfo':
			var animation = jQuery('[name="contactinfo_animation"]').val();
            var name = jQuery('[name="contactinfo_name"]').val();
            var address = jQuery('[name="contactinfo_address"]').val();
            var email = jQuery('[name="contactinfo_email"]').val();
            var phone = jQuery('[name="contactinfo_phone"]').val();
            var link = jQuery('[name="contactinfo_link"]').val();
            if (name != '') {
                name = ' name="' + name + '"';
            }
            if (address != '') {
                address = ' address="' + address + '"';
            }
            if (email != '') {
                email = ' email="' + email + '"';
            }
            if (phone != '') {
                phone = ' phone="' + phone + '"';
            }
            if (link != '') {
                link = ' link="' + link + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
            return '\n[contactinfo ' + animation + name + address + email + phone + link + ']\n';
            break;

            // V I M E O 
            //--------------------------------------------------------
        case 'vimeo':
            var clip_id = jQuery('[name="vimeo_clipid"]').val();
            var autoplay = jQuery('[name="vimeo_autoplay"]');
            if (clip_id != '') {
                clip_id = ' clip_id="' + clip_id + '"';
            }
            if (autoplay.is('.atp-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="1"';
                } else {
                    autoplay = ' autoplay="0"';
                }
            }

            return '\n[vimeo' + clip_id + autoplay + ']\n';
            break;
            // Y O U T U B E
            //--------------------------------------------------------
        case 'youtube':
            var clipid = jQuery('[name="youtube_clipid"]').val();
            var autoplay = jQuery('[name="youtube_autoplay"]');
            if (clipid != '') {
                clip_id = ' clipid="' + clipid + '"';
            }
            if (autoplay.is('.atp-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="1"';
                } else {
                    autoplay = ' autoplay="0"';
                }
            }

            return '\n[youtube' + clip_id + autoplay + ']\n';
            break;
            // P O R T F O L I O
            //--------------------------------------------------------
        case 'portfolio':
            var shortcodesub_type = jQuery('#secondary_portfolio select').val();
            switch (shortcodesub_type) {
            case 'normal':
                var columns = jQuery('[name="portfolio_normal_column"]').val();
                var portfolio_cat = jQuery('[name="portfolio_normal_cat[]"]').val();
                var portfoliotitle = jQuery('[name="portfolio_normal_title"]');
                var portfoliodesc = jQuery('[name="portfolio_normal_description"]');
                var portfolio_sidebar = jQuery('[name="portfolio_normal_sidebar"]');
                var portfolio_limit = jQuery('[name="portfolio_normal_limit"]').val();
                var portfolio_limitcontent = jQuery('[name="portfolio_normal_limitcontent"]').val();
                var portfoliopagination = jQuery('[name="portfolio_normal_pagination"]');
                if (columns != "") {
                    columns = ' columns="' + columns + '"';
                } else {
                    columns = ' columns="4"';
                }
                if (portfoliotitle.is('.atp-button')) {
                    if (portfoliotitle.is(':checked')) {
                        title = ' title="false"';
                    } else {
                        title = ' title="true"';
                    }
                }
                if (portfoliodesc.is('.atp-button')) {
                    if (portfoliodesc.is(':checked')) {
                        desc = ' desc="false"';
                    } else {
                        desc = ' desc="true"';
                    }
                }

                if (portfolio_cat == null) {
                    portfolio_cat = "";
                }
                if (portfolio_cat != "") {
                    cat = ' cat="' + portfolio_cat + '"';
                } else {
                    cat = ' cat=""';
                }
                if (portfolio_limit != "") {
                    limit = ' limit="' + portfolio_limit + '"';
                } else {
                    limit = '';
                }
                if (portfolio_sidebar.is('.atp-button')) {
                    if (portfolio_sidebar.is(':checked')) {
                        sidebar = ' sidebar="false"';
                    } else {
                        sidebar = ' sidebar="true"';
                    }
                }

                if (portfoliopagination.is('.atp-button')) {
                    if (portfoliopagination.is(':checked')) {
                        pagination = ' pagination="false"';
                    } else {
                        pagination = ' pagination="true"';
                    }
                }
                if (portfolio_limitcontent != "") {
                    charlimits = ' charlimits="' + portfolio_limitcontent + '"';
                } else {
                    charlimits = '';
                }

                return '[portfolio' + columns + cat + title + desc + limit + charlimits + pagination + sidebar + ']';
                break;
            case 'sortable':
                var columns = jQuery('[name="portfolio_sortable_column"]').val();
                var portfolio_cat = jQuery('[name="portfolio_sortable_cat[]"]').val();
                var portfoliotitle = jQuery('[name="portfolio_sortable_title"]');
                var portfolio_sidebar = jQuery('[name="portfolio_sortable_sidebar"]');
                var portfolio_limit = jQuery('[name="portfolio_sortable_limit"]').val();
                var portfoliopagination = jQuery('[name="portfolio_sortable_pagination"]');
                if (columns != "") {
                    columns = ' columns="' + columns + '"';
                } else {
                    columns = ' columns="4"';
                }
                if (portfoliotitle.is('.atp-button')) {
                    if (portfoliotitle.is(':checked')) {
                        title = ' title="false"';
                    } else {
                        title = ' title="true"';
                    }
                }
                if (portfolio_cat == null) {
                    portfolio_cat = "";
                }
                if (portfolio_cat != "") {
                    cat = ' cat="' + portfolio_cat + '"';
                } else {
                    cat = ' cat=""';
                }
                if (portfolio_limit != "") {
                    limit = ' limit="' + portfolio_limit + '"';
                } else {
                    limit = '';
                }
                if (portfolio_sidebar.is('.atp-button')) {
                    if (portfolio_sidebar.is(':checked')) {
                        sidebar = ' sidebar="false"';
                    } else {
                        sidebar = ' sidebar="true"';
                    }
                }
                if (portfoliopagination.is('.atp-button')) {
                    if (portfoliopagination.is(':checked')) {
                        pagination = ' pagination="false"';
                    } else {
                        pagination = ' pagination="true"';
                    }
                }
                sortable = ' sortable="true"';

                return '[portfolio' + columns + cat + title + limit + pagination + sidebar + sortable + ']';
                break;
            }

            break;
		 // A L B U M N
        //--------------------------------------------------------			
		case 'album':
   
			var columns			= jQuery('[name="album_alb_column"]').val();
			var album_genres	= jQuery('[name="album_alb_genrescat[]"]').val();
			var album_label		= jQuery('[name="album_alb_labelcat[]"]').val();
			var album_limit		= jQuery('[name="album_alb_limit"]').val();
			var albumpagination = jQuery('[name="album_alb_pagination"]');
			var albumordering 	= jQuery('[name="album_alb_ordering"]');
			var album_postid	= jQuery('[name="album_alb_postid"]').val();
			var album_id_display= jQuery('[name="album_alb_id_display"]').val();
			var album_select 	= jQuery('#album_alb_select').val();

			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}

			if(album_id_display!= ""){
				id = ' id="' + album_id_display + '"';
			}else{
				id = '';
			}

			if(album_postid!= ""){
				postid = ' postid="' + album_postid + '"';
			}else{
				postid = '';
			}
			
			if (album_genres == null) {
				album_genres = "";
			}
			if (album_genres != "") {
				genres = ' genres="' + album_genres + '"';
			} else {
				genres = '';
			}
			
			if (album_label == null) {
				album_label = "";
			}
			if (album_label != "") {
				label = ' label="' + album_label + '"';
			} else {
				label = '';
			}	
	
			if (album_limit != "") {
				limit = ' limit="' + album_limit + '"';
			} else {
				limit = '';
			}

			if (albumordering.is(':checked')) {
				ordering = ' ordering="yes"';
			} else {
				ordering = ' ordering="no"';
			}


			if (albumpagination.is('.atp-button')) {
				if (albumpagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			
			if ( album_select == 'postids') {
				return '[album' +  postid +']';
			}else if( album_select == 'id') {
				return '[album' + id +']';
			}else if( album_select == 'categories') {
				return '[album' + columns + genres + label + limit + ordering +  pagination + ']';
			}
			
			break;

		// E V E N T S
		//--------------------------------------------------------
		case 'events':   
			var event_limit 		= jQuery('[name="events_eve_limit"]').val();
			var event_postid 		= jQuery('[name="events_eve_postid"]').val();
			var event_cat			= jQuery('[name="events_eve_cat[]"]').val();
			var eventpagination 	= jQuery('[name="events_eve_pagination"]');
			var event_sorting 		= jQuery('[name="events_eve_sorting"]').val();
			var event_style 		= jQuery('[name="events_eve_style"]').val();
			if (event_cat != "") {
                cat = ' cat="' + event_cat + '"';
			} else {
				cat = ' cat=""';
			}
			
			if (event_style != "") {
                style = ' style="' + event_style + '"';
			} else {
				style = ' style=""';
			}
			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}
			
			if(event_postid!= ""){
				postid = ' postid="' + event_postid + '"';
			}else{
				postid = '';
			}
			
			if (event_limit != "") {
				limit = ' limit="' + event_limit + '"';
			} else {
				limit = '';
			}

		   	if (event_sorting != "") {
				sorting = ' sorting="' + event_sorting + '"';
			} else {
				sorting = ' sorting="past_events"';
			}
			
			if (eventpagination.is('.atp-button')) {
				if (eventpagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			
			if ( event_sorting == 'postids') {
				return '[musicevents' + postid + sorting +  limit +']';
			}else if( event_sorting == 'upcoming_events') {
				return '[musicevents' + sorting + cat +style+  limit +  pagination + ']';
			}else if( event_sorting == 'past_events') {
				return '[musicevents' + sorting + cat +style+  limit +  pagination + ']';
			}
			break;

		// A R T I S T
		//--------------------------------------------------------
		case 'artist':
   
			var columns 			= jQuery('[name="artist_art_column"]').val();
			var artist_limit 		= jQuery('[name="artist_art_limit"]').val();
			var artist_cat			= jQuery('[name="artist_art_artistcat[]"]').val();
			var artistpostid 		= jQuery('[name="artist_art_postid"]').val();
			var artistpagination 	= jQuery('[name="artist_art_pagination"]');
			var artist_select 		= jQuery('#artist_art_select').val();
			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}
			
			if (artist_cat == null) {
				cat = "";
			}
			if (artistpostid == null) {
				postid = "";
			}
			if (artist_cat != "") {
				cat = ' cat="' + artist_cat + '"';
			} else {
				cat = '';
			}
			if (artistpostid != "") {
				postid = ' postid="' + artistpostid + '"';
			} else {
				postid = '';
			}
			
			if (artist_limit == null) {
				artist_limit = "";
			}
			if (artist_limit != "") {
				limit = ' limit="' + artist_limit + '"';
			} else {
				limit = '';
			}

			if (artistpagination.is('.atp-button')) {
				if (artistpagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			
			if ( artist_select == 'artist_postids') {
				return '[artist' + postid +']';
			}else if( artist_select == 'artist_cat') {
				return '[artist' + cat + columns + limit +  pagination + ']';
			}
		
			break;

		// G A L L E R Y
		//--------------------------------------------------------
	case 'gallery':   
			var columns 			= jQuery('[name="gallery_gal_column"]').val();
			var gallery_cat 		= jQuery('[name="gallery_gal_cat[]"]').val();
			var gallery_limit 		= jQuery('[name="gallery_gal_limit"]').val();
			var gallerypagination 	= jQuery('[name="gallery_gal_pagination"]');
			var gallerypostid 		= jQuery('[name="gallery_gal_postid"]').val();
			var gallery_select 		= jQuery('#gallery_gal_select').val();
			
			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}
			
			if (gallery_cat == null) {
				gallery_cat = "";
			}
			
			if (gallery_cat != "") {
				cat = ' cat="' + gallery_cat + '"';
			} else {
				cat = ' cat=""';
			}
			
			if (gallerypostid != "") {
				postid_g = ' postid_g="' + gallerypostid + '"';
			} else {
				postid_g = '';
			}
			
			if (gallery_limit != "") {
				limit = ' limit="' + gallery_limit + '"';
			} else {
				limit = '';
			}
		   
			if (gallerypagination.is('.atp-button')) {
				if (gallerypagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			if ( gallery_select == 'gallery_postids') {
				return '[musicgallery'  + postid_g +']';
			}else if( gallery_select == 'gallery_cat') {
				return '[musicgallery' + columns + cat + limit +  pagination + ']';
			}
		
			break;
			
			// V I D E O
			//--------------------------------------------------------
			case 'video':
			var columns 			= jQuery('[name="video_vid_column"]').val();
			var video_limit 		= jQuery('[name="video_vid_limit"]').val();
			var video_postid 		= jQuery('[name="video_vid_postid"]').val();
			var videopagination 	= jQuery('[name="video_vid_pagination"]');
			var video_limit 		= jQuery('[name="video_vid_limit"]').val();
			var video_cat 			= jQuery('[name="video_vid_cat[]"]').val();
			var video_select 		= jQuery('#video_vid_select').val();
			
			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}
			if (video_postid != "") {
				postid = ' postid="' + video_postid + '"';
			} else {
				postid = '';
			}
			
			if (video_limit != "") {
				limit = ' limit="' + video_limit + '"';
			} else {
				limit = '';
			}
		   	if (video_cat != "") {
				cat = ' cat="' + video_cat + '"';
			} else {
				cat = ' cat=""';
			}
			if (videopagination.is('.atp-button')) {
				if (videopagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			if ( video_select == 'video_postids') {
				return '[musicvideo'  +  postid +']';
			}else if( video_select == 'video_cat') {
				return '[musicvideo' + columns + limit + cat + pagination + ']';
			}
			break;

		// D J M I X
		//--------------------------------------------------------
		case 'djmix':   
			var columns 		= jQuery('[name="djmix_djm_column"]').val();
			var djmix_cat 		= jQuery('[name="djmix_djm_cat[]"]').val();
			var djmix_limit 	= jQuery('[name="djmix_djm_limit"]').val();
			var djmixpagination = jQuery('[name="djmix_djm_pagination"]');
			var djmix_postid 	= jQuery('[name="djmix_djm_postid"]').val();
			var djmix_select 	= jQuery('#djmix_djm_select').val();

			if (columns != "") {
				columns = ' columns="' + columns + '"';
			} else {
				columns = ' columns="4"';
			}
			
			if (djmix_cat == null) {
				djmix_cat = "";
			}
			if (djmix_cat != "") {
				cat = ' cat="' + djmix_cat + '"';
			} else {
				cat = ' cat=""';
			}
			
			if (djmix_postid != "") {
				postid = ' postid="' + djmix_postid + '"';
			} else {
				postid = '';
			}

			if (djmix_limit != "") {
				limit = ' limit="' + djmix_limit + '"';
			} else {
				limit = '';
			}
		   
			if (djmixpagination.is('.atp-button')) {
				if (djmixpagination.is(':checked')) {
					pagination = ' pagination="false"';
				} else {
					pagination = ' pagination="true"';
				}
			}  
			
			if ( djmix_select == 'djmix_postids') {
					return '[musicdjmix'  + postid +']';
			}else if( djmix_select == 'djmix_cat') {
				return '[musicdjmix' + columns + cat + limit +  pagination + ']';
			}

		
			
			break;
        case 'progressbar':
			var animation = jQuery('[name="progressbar_animation"]').val();
            var progress_width = jQuery('[name="progressbar_percentage"]').val();
            var progresstitle = jQuery('[name="progressbar_title"]').val();
            var progress_color = jQuery('[name="progressbar_color"]').val();
            var progress_bgcolor = jQuery('[name="progressbar_bgcolor"]').val();
            if (progress_width != '') {
                progress = ' progress="' + progress_width + '"';
            } else {
                progress = '';
            }
            if (progresstitle != '') {
                title = ' title="' + progresstitle + '"';
            } else {
                title = '';
            }
            if (progress_color != '') {
                color = ' color="' + progress_color + '"';
            } else {
                color = '';
            }
            if (progress_bgcolor != '') {
                bgcolor = ' bgcolor="' + progress_bgcolor + '"';
            } else {
                bgcolor = '';
            }
			if (animation != '') {
				animation = ' animation="' + animation + '"';
            } 	
			
            return '\n[progressbar' + animation + progress + color + title + bgcolor + ']\n';
            break;

            // P R O G R E S S C I R C L E
            //---------------------------------------------------------
        case 'progresscircle':			
            var pcirclecount = jQuery('[name="progresscircle_pcirclecolumns"]').val();
			var animation = jQuery('[name="progresscircle_animation"]').val();
			if (animation != '') {
				animation = ' animation="' + animation + '"';
            } 
            var outputs = '[progresscircle ' + animation + ']\n';
            for (var i = 1; i <= pcirclecount; i++) {
                outputs += '[progress title="Content" percent="50" color="#9f5bb4"  trackcolor="#eeeeee"  size="110" linewidth="10"]Text[/progress]\n';
            }
            outputs += '[/progresscircle]';

            return outputs;
            break;
            // S T A F F
            //-------------------------------------------------------
        case 'staff':
            var staff_photo = jQuery("[name=staff_photo]").val();
			var animation = jQuery('[name="staff_animation"]').val();
            var staff_title = jQuery('[name="staff_title"]').val();
            var staff_role = jQuery('[name="staff_role"]').val();
            var staff_content = jQuery('[name="staff_content"]').val();
            var arr = ['blogger', 'delicious', 'digg', 'facebook', 'flickr', 'forrst', 'google', 'linkedin', 'pinterest', 'skype', 'stumbleupon', 'twitter', 'dribbble', 'yahoo', 'youtube'];
            jQuery.each(arr, function (key, value) {
                if (jQuery('[name="staff_' + value + '"]').val() !== 'undefined' && jQuery('[name="staff_' + value + '"]').val() !== '') {
                    jQuery('#atp-sociables-result').val(jQuery('#atp-sociables-result').val() + ' ' + value + '="' + jQuery('[name="staff_' + value + '"]').val() + '"');
                }
            });
            jQuery('#atp-sociables-result').val(jQuery('#atp-sociables-result').val());
            var staff_sociables = jQuery('#atp-sociables-result').val();
            if (staff_photo != '') {
                photo = ' photo="' + staff_photo + '"';
            } else {
                photo = '';
            }
            if (staff_title != '') {
                title = ' title="' + staff_title + '"';
            } else {
                title = '';
            }
            if (staff_role != '') {
                role = ' role="' + staff_role + '"';
            } else {
                role = '';
            }
            if (staff_content !== '') {
                content = '' + staff_content + '';
            } else {
                content = '';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}			
            jQuery('#atp-sociables-result').val('');

            return '[staff' + animation + photo + title + role + staff_sociables + ']' + content + '[/staff]\n';
            break;
            // T E S T I M O N I A L
            //--------------------------------------------------------
        case 'testimoniallist':
            var testimoniallist_cat = jQuery('[name="testimoniallist_category[]"]').val();
            var testimoniallist_max = jQuery('[name="testimoniallist_limit"]').val();
            if (testimoniallist_cat == null) {
                testimoniallist_cat = "";
            }
            if (testimoniallist_max != "") {
                max = ' limit="' + testimoniallist_max + '"';
            } else {
                max = '';
            }
            if (testimoniallist_cat != "") {
                cat = ' cat="' + testimoniallist_cat + '"';
            } else {
                cat = ' cat=""';
            }

            return '[testimoniallist' + cat + max + ']';
            break;
            // T E S T I M O N I A L C A R O U S E L
        case 'testimonialcarousel':
            var testimonial_cat = jQuery('[name="testimonialcarousel_category[]"]').val();
            var testimonial_max = jQuery('[name="testimonialcarousel_limit"]').val();
            var testimonial_title = jQuery('[name="testimonialcarousel_title"]').val();
			var testimonial_items = jQuery('[name="testimonialcarousel_items"]').val();
            if (testimonial_cat == null) {
                testimonial_cat = "";
            }
            if (testimonial_title != "") {
                title = ' title="' + testimonial_title + '"';
            } else {
                title = '';
            }
			if (testimonial_items != "") {
                items = ' items="' + testimonial_items + '"';
            } else {
                items = '';
            }

            if (testimonial_max != "") {
                max = ' limit="' + testimonial_max + '"';
            } else {
                max = '';
            }
            if (testimonial_cat != "") {
                cat = ' cat="' + testimonial_cat + '"';
            } else {
                cat = ' cat=""';
            }

            return '[testimonialcarousel' + cat + items + max + title + ']';
            break;
            // B L O G  S L I D E R  
            //--------------------------------------------------------
        case 'blogcarousel':
            var blogcarousel_cat = jQuery('[name="blogcarousel_cat[]"]').val();
            var blogcarousel_max = jQuery('[name="blogcarousel_limit"]').val();
            var blogcarousel_title = jQuery('[name="blogcarousel_title"]').val();
			var blogcarousel_items = jQuery('[name="blogcarousel_items"]').val();
            var blogcarousel_style = jQuery('[name="blogcarousel_style"]').val();
            if (blogcarousel_cat != "") {
                cat = ' cat="' + blogcarousel_cat + '"';
            } else {
                cat = '';
            }
            if (blogcarousel_max != "") {
                max = ' limit="' + blogcarousel_max + '"';
            } else {
                max = '';
            }
            if (blogcarousel_title != "") {
                title = ' title="' + blogcarousel_title + '"';
            } else {
                title = '';
            }
			if (blogcarousel_items != "") {
                items = ' items="' + blogcarousel_items + '"';
            } else {
                items = '';
            }
            if (blogcarousel_style != "") {
                style = ' style="' + blogcarousel_style + '"';
            } else {
                style = '';
            }

            return '[blog_carousel' + cat + max + title + items + style + ']';
            break;
		// 
		// C A R O U S E L
		//------------------------------------------------------------------
		case 'carousel':
			var carousel = jQuery('[name="carousel_type"]').val();

			var labels = jQuery('[name="carousel_alb_labelcat[]"]').val();
			var genres = jQuery('[name="carousel_alb_genrescat[]"]').val();
			var artist_cat = jQuery('[name="carousel_art_artistcat[]"]').val();
			var video_cat = jQuery('[name="carousel_vid_videocat[]"]').val();
			var gallery_cat = jQuery('[name="carousel_gal_galcat[]"]').val();

            var carousel_max = jQuery('[name="carousel_limit"]').val();
			var carousel_items = jQuery('[name="carousel_items"]').val();
			
			if ( carousel ) { type = ' type="' + carousel + '"'; }

            if ( labels != null && labels != "" ) { labels = ' labels="' + labels + '"'; } else { labels = ''; }
            if ( genres != null && genres != "" ) { genres = ' genres="' + genres + '"'; } else { genres = ''; }
            if ( artist_cat != null && artist_cat != "" ) { artist_cat = ' artist_cat="' + artist_cat + '"'; } else { artist_cat = ''; }
            if ( video_cat != null && video_cat != "" ) { video_cat = ' video_cat="' + video_cat + '"'; } else { video_cat = ''; }
            if ( gallery_cat != null && gallery_cat != "" ) { gallery_cat = ' gallery_cat="' + gallery_cat + '"'; } else { gallery_cat = ''; }

            if ( carousel_max ) { max = ' limit="' + carousel_max + '"'; } else { max = ''; }
			if ( carousel_items ) { items = ' items="' + carousel_items + '"'; } else { items = ''; }

			if( carousel == 'albums') {
				return '[iva_carousel' + type + labels + genres +  max + items + ']';
			}
			if( carousel == 'artists') {
				return '[iva_carousel' + type + artist_cat +  max + items + ']';
			}
			if( carousel  == 'video') {
				return '[iva_carousel' + type + video_cat +  max + items + ']';
			}
			if( carousel == 'gallery') {
				return '[iva_carousel' + type + gallery_cat +  max + items + ']';
			}
			break;
		// S E R V I C E S
		//--------------------------------------------------------
        case 'services':
			var animation = jQuery('[name="services_animation"]').val();
            var imagesrc = jQuery('[name="services_image"]').val();
            var text = jQuery('[name="services_text"]').val();
            var align = jQuery('[name="services_align"]').val();
			var title = jQuery('[name="services_title"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (imagesrc !== '') {
                imagesrc = ' image="' + imagesrc + '"';
            }
			if (title !== '') {
                title = ' title="' + title + '"';
            }			
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
			
            return '\n[services' + animation + align + imagesrc + title + ']\n' + text + '\n[/services]\n';
            break;
	   // Blog
            //--------------------------------------------------------
		case 'blog':
            var blog_cat = jQuery('[name="blog_cat[]"]').val();
            var blog_max = jQuery('[name="blog_limit"]').val();

            var blogpagination = jQuery('[name="blog_pagination"]');
            var postmeta = jQuery('[name="blog_postmeta"]');
            if (blogpagination.is('.atp-button')) {
                if (blogpagination.is(':checked')) {
                    pagination = ' pagination="true"';
                } else {
                    pagination = ' pagination="false"';
                }
            }
            if (postmeta.is('.atp-button')) {
                if (postmeta.is(':checked')) {
                    postmeta = ' postmeta="true"';
                } else {
                    postmeta = ' postmeta="false"';
                }
            }
            if (blog_cat != "") {
                cat = ' cat="' + blog_cat + '"';
            } else {
                cat = '';
            }
            if (blog_max != "") {
                max = ' limit="' + blog_max + '"';
            } else {
                max = '';
            }
            return '[blog' + cat + max + pagination + postmeta + ']';
            break;
            // S E R V I C E S I C O N
            //--------------------------------------------------------
        case 'servicesicon':
			var animation = jQuery('[name="servicesicon_animation"]').val();
            var icon = jQuery('[name="servicesicon_icon"]').val();
            var text = jQuery('[name="servicesicon_text"]').val();
            var title = jQuery('[name="servicesicon_title"]').val();
            var bgcolor = jQuery('[name="servicesicon_bgcolor"]').val();
            var color = jQuery('[name="servicesicon_color"]').val();
            var align = jQuery('[name="servicesicon_align"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (title !== '') {
                title = ' title="' + title + '"';
            }
            if (align !== '') {
                align = ' align="' + align + '"';
            }
            if (icon !== '') {
                icon = ' icon="' + icon + '"';
            }
            if (bgcolor !== '') {
                bgcolor = ' bgcolor="' + bgcolor + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
			
            return '\n[servicesicon' + animation +  align + icon + color + bgcolor + title + ']\n' + text + '\n[/servicesicon]\n';
            break;

            // F E A T U R E B O X
            //--------------------------------------------------------
        case 'featurebox':
            var imagesrc = jQuery('[name="featurebox_image"]').val();
            var text = jQuery('[name="featurebox_text"]').val();
            var color = jQuery('[name="featurebox_color"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (color !== '') {
                color = ' bgcolor="' + color + '"';
            }
            if (imagesrc !== '') {
                imagesrc = ' image="' + imagesrc + '"';
            }

            return '\n[featurebox' + color + imagesrc + ']\n' + text + '\n[/featurebox]\n';
            break;
		// R E C E N T   P O S T S 
		//--------------------------------------------------------	
		case 'recentposts':
			var thumb		 = jQuery('[name="recentposts_thumb"]');
			var postdate	 = jQuery('[name="recentposts_postdate"]');
			var recentlimit		 = jQuery('[name="recentposts_postlimit"]').val();
			var description	 = jQuery('[name="recentposts_description"]').val();
			var cat_id		 = jQuery('[name="recentposts_cat_id[]"]').val();
			
			if( thumb.is('.atp-button') ){
				if( thumb.is(':checked') ){
					thumb= ' thumb="true"';	
				}else{
					thumb= ' thumb="false"';
				}
			}	
			if( postdate.is('.atp-button') ){
				if( postdate.is(':checked') ){
					postdate= ' postdate="true"';
				}else{
					postdate= ' postdate="false"';
				}
			}	
			if( description!=''){ 
				description =' description="'+description+'" ';
			}
			if( recentlimit!='' ){ 
				recentlimit =' limit="'+recentlimit+'" ';
			}
			if( cat_id!='' ){
				cat_id =' cat_id="'+cat_id+'" ';
			}
			return '\n[recentposts'+thumb+postdate+description+recentlimit+cat_id+']\n';
			break;
		// P O P U L A R   P O S T S 
		//--------------------------------------------------------
		case 'popularposts':
				var popular_thumb	= jQuery('[name="popularposts_thumb"]');
				var popular_limit	= jQuery('[name="popularposts_limit"]').val();
				var popular_desc	= jQuery('[name="popularposts_description"]').val();
				var popular_select		= jQuery('#popularposts_popularselect').val();
				
				if( popular_thumb.is('.atp-button') ){
					if( popular_thumb.is(':checked') ){
						popular_thumb= ' thumb="true"';
					}else{
						popular_thumb= ' thumb="false"';
					}
				}	
				if( popular_limit!='' ){ 
					popular_limit =' limit="'+popular_limit+'"';
				}
				if( popular_select!='' ){ 
					popular_select =' popular_select="'+popular_select+'"';
				}
				if( popular_desc!=''){ 
					popular_desc =' description="'+popular_desc+'" ';
				}
				return '\n[popularposts'+popular_thumb+popular_limit+popular_desc+popular_select+']\n';
				break;
            // S O U N D   C L O U D M A W K S T A R T
            //--------------------------------------------------------
        case 'soundcloud':
            var width = jQuery('[name="soundcloud_width"]').val();
            var height = jQuery('[name="soundcloud_height"]').val();
            var type = jQuery('[name="soundcloud_type"]').val();
            var show_art = jQuery('[name="soundcloud_show_art"]');
            var color = jQuery('[name="soundcloud_color"]').val();
            var audio_id = jQuery('[name="soundcloud_audio_id"]').val();
            var autoplay = jQuery('[name="soundcloud_autoplay"]');
            if (width != '') {
                width = ' width="' + width + '"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            }
            if (type != '') {
                type = ' type="' + type + '"';
            }
            if (color != '') {
                color = ' color="' + color + '"';
            }
            if (audio_id != '') {
                audio_id = ' audio_id="' + audio_id + '"';
            }
            if (autoplay.is('.atp-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="ture"';
                } else {
                    autoplay = ' autoplay="false"';
                }
            }
            if (show_art.is('.atp-button')) {
                if (show_art.is(':checked')) {
                    show_art = ' show_art="ture"';
                } else {
                    show_art = ' show_art="false"';
                }
            }

            return '\n[soundcloud' + type + width + height + audio_id + autoplay + color + show_art + ']\n';
            break;
        }
    },
    sendToEditor: function () {
        send_to_editor(shortcode.generate());
    }
}

jQuery(document).ready(function () {
    jQuery('.staff_delete').on("click", function () {
        jQuery(this).closest('tr').hide();
        //e.preventDefault();
    });
    shortcode.init();
    jQuery("select[name=staff_selectsociable]").on('change', function (e) {
        jQuery('#secondary_staff table').find("." + this.value).show();
        //e.preventDefault();
    });

	// Allbum
	jQuery("tr.albumselect").hide();
	jQuery("#album_alb_select").on('change', function () {
		jQuery(".albumselect").hide();
		albumoption = jQuery("#album_alb_select option:selected").val();
		jQuery("."+albumoption).show();
	});
	//Events
	jQuery("tr.shortevent").hide();
	jQuery("#events_eve_sorting").on('change', function () {
		jQuery(".shortevent").hide();
		eventoption = jQuery("#events_eve_sorting option:selected").val();
		jQuery("."+eventoption).show();
	});
	//Artist
	jQuery("tr.shortartist ").hide();
	jQuery("#artist_art_select").on('change', function () {
		jQuery("tr.shortartist ").hide();
		artistoption = jQuery("#artist_art_select option:selected").val();
		jQuery("."+artistoption).show();
	});	

	//Gallery
	jQuery("tr.shortgallery ").hide();
	jQuery("#gallery_gal_select").on('change', function () {
		jQuery("tr.shortgallery ").hide();
		galleryoption = jQuery("#gallery_gal_select option:selected").val();
		jQuery("."+galleryoption).show();
	});		
	//Video
	jQuery("tr.shortvideo ").hide();
	jQuery("#video_vid_select").on('change', function () {
		jQuery("tr.shortvideo ").hide();
		videooption = jQuery("#video_vid_select option:selected").val();
		jQuery("."+videooption).show();
	});	

	//Djmix
	jQuery("tr.shortdjmix ").hide();
	jQuery("#djmix_djm_select").on('change', function () {
		jQuery("tr.shortdjmix ").hide();
		djmixoption = jQuery("#djmix_djm_select option:selected").val();
		jQuery("."+djmixoption).show();
	});	
	
	// Carousel custom post type 
	jQuery("tr.gal_galcat, tr.alb_labelcat, tr.alb_genrescat, tr.vid_videocat, tr.art_artistcat").hide();
	jQuery("#carousel_type").on('change', function () {
		jQuery("tr.gal_galcat, tr.alb_labelcat, tr.alb_genrescat, tr.vid_vidcat, tr.art_artistcat").hide();
		videooption = jQuery("#carousel_type option:selected").val();
		jQuery("."+videooption).show();
	});
		
});
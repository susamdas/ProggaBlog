jQuery(document).ready(function($){
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-magazine_newspaper_theme_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });
    $('body').on('click', '#sub-accordion-panel-magazine_newspaper_header_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });
    
    /*//preview url of homepages templates 
     wp.customize.panel( 'bootstrap_coach_homepage_panel', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( data.home );
            }
        });
    });*/
     
});

function scrollToSection( section_id ){

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-magazine_newspaper_detail_news_sections':
        preview_section_id = "magazine_newspaper_detail_news_sections";
        break;

        case 'accordion-section-magazine_newspaper_banner_news_sections':
        preview_section_id = "magazine_newspaper_banner_news_sections";
        break;

        case 'accordion-section-magazine_newspaper_breaking_news':
        preview_section_id = "magazine_newspaper_breaking_news";
        break;

        case 'accordion-section-magazine_newspaper_popular_news_sections':
        preview_section_id = "magazine_newspaper_popular_news_sections";
        break;

        case 'accordion-section-magazine_newspaper_recent_news_sections':
        preview_section_id = "magazine_newspaper_recent_news_sections";
        break;

        case 'accordion-section-magazine_newspaper_top_news_sections':
        preview_section_id = "magazine_newspaper_top_news_sections";
        break;

        case 'accordion-section-magazine_newspaper_social_media_sections':
        preview_section_id = "magazine_newspaper_social_media_sections";
        break;

        case 'accordion-section-magazine_newspaper_header_search_section':
        preview_section_id = "magazine_newspaper_header_search_section";
        break;
        
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
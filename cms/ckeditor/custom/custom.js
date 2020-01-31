/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
  config.extraPlugins = 'wordcount';
    config.wordcount = {
    	showParagraphs: false,
        // Whether or not you want to show the Word Count
        showWordCount: false,

        // Whether or not you want to show the Char Count
        showCharCount: true,
        
        // Maximum allowed Word Count
        maxWordCount: 4,

        // Maximum allowed Char Count
        maxCharCount: 300,

        // Whether or not you want to count Spaces as Chars
    	countSpacesAsChars: true,

	    // Whether or not to include Html chars in the Char Count
	    countHTML: false,
      };
};

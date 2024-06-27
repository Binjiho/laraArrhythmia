CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';  
  config.docType = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
  config.font_defaultLabel = '����';
  config.font_names = '����/Gulim;����/Dotum;����/Batang;�ü�/Gungsuh;Arial/Arial;Comic Sans MS/Comic Sans MS;Courier New/Courier New;Georgia/Georgia;Lucida Sans Unicode/Lucida Sans Unicode;Tahoma/Tahoma;Times New Roman/Times New Roman;Trebuchet MS/Trebuchet MS;Verdana/Verdana';
  config.fontSize_defaultLabel = '12px';
  config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;';
  config.resize_enabled = true;
  config.enterMode = CKEDITOR.ENTER_BR;
  config.shiftEnterMode = CKEDITOR.ENTER_P;
  config.startupFocus = true;
  config.uiColor = '#eaebe7';
  config.toolbarCanCollapse = false;
  config.menu_subMenuDelay = 0;
  config.width ='100%';
  config.height ='250';
  config.toolbar = [
      ['Font','FontSize'],
      ['Bold','Italic','Subscript','Superscript','TextColor','BGColor','Blockquote','RemoveFormat'],
      ['NumberedList','BulletedList'],
      ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
      ['Link','Unlink','Find','Replace','SelectAll','-','Image','Table','Smiley','SpecialChar'],
      ['Source','Preview','Templates','Print']
  ];
    // config.toolbar = [['Font','FontSize'],['Bold','Italic','Underline','Strike','Subscript','Superscript','TextColor','BGColor','Blockquote','RemoveFormat','NumberedList','BulletedList'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Link','Unlink','Find','Replace','SelectAll','-','Image','Table','Smiley','SpecialChar'],['Source','Preview','Templates','Print'],['Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo','Maximize']];
config.extraPlugins = 'wordcount';

config.wordcount = {

	// Whether or not you want to show the Paragraphs Count
	showParagraphs: false,

	// Whether or not you want to show the Word Count
	showWordCount: false,

	// Whether or not you want to show the Char Count
	showCharCount: false,

	// 2018-01-24 바이트 카운트 추가
	showbyteCount: true,

	// Whether or not you want to count Spaces as Chars
	countSpacesAsChars: false,

	// Whether or not to include Html chars in the Char Count
	countHTML: false,
	
	// Maximum allowed Word Count, -1 is default for unlimited
	maxWordCount: -1,

	// Maximum allowed Char Count, -1 is default for unlimited
	maxCharCount: -1
};
};
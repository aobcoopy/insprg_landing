/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	
	config.removeButtons = 'Source,Save,Templates,NewPage,Preview,Print,Find,Replace,SelectAll,Scayt,Form,Radio,TextField,Textarea,Checkbox,Select,Button,ImageButton,HiddenField,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Link,BidiLtr,Blockquote,Outdent,NumberedList,BulletedList,CreateDiv,BidiRtl,Unlink,Anchor,Language,Indent,Maximize,About,ShowBlocks,Superscript,Subscript,RemoveFormat';
	
	config.skin = 'bootstrapck';
};

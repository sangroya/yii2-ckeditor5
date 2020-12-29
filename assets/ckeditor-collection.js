let CKEditor= new Map();
CKEditor.insertText=(element,content)=>{
   
    var editor=CKEditor.get(element);
    var viewFragment = editor.data.processor.toView( content );
    var modelFragment = editor.data.toModel( viewFragment );
    editor.model.insertContent( modelFragment );
};

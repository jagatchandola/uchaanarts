@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('backend/css/richtext.min.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Testimonial</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="edit-testimonial-form" action="{{ route('edit-testimonial-post') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="testimonial-id" value="{{ $testimonial->id }}" />

                                            <div class="form-group">
                                                <label>Image: <img src="{{ \App\Helpers\Helper::getImage($testimonial->image, 2) }}" width="200" height="100"></label>
                                           
                                                <input class="form-control" type="file" name="image" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" name="name" value="{{ $testimonial->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input class="form-control" type="text" name="designation" value="{{ $testimonial->designation }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea class="form-control content1" name="content" required>{{ $testimonial->content }}</textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" @if($testimonial->status == 1) checked @endif>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" @if($testimonial->status == 0) checked @endif>Inactive
                                                </label>                                                
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>                                    
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

        </div>
        <!-- /#wrapper -->
@endsection

@section('script')
<script src="{{ asset('backend/js/jquery.richtext.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

   $('.content1').richText({
  // text formatting
  bold: true,
  italic: true,
  underline: true,

  // text alignment
  leftAlign: true,
  centerAlign: true,
  rightAlign: true,

  // lists
  ol: true,
  ul: true,

  // title
  heading: true,

  // fonts
  fonts: true,
  fontList: ["Arial", 
    "Arial Black", 
    "Comic Sans MS", 
    "Courier New", 
    "Geneva", 
    "Georgia", 
    "Helvetica", 
    "Impact", 
    "Lucida Console", 
    "Tahoma", 
    "Times New Roman",
    "Verdana"
    ],
  fontColor: true,
  fontSize: true,

  // uploads
  imageUpload: false,
  fileUpload: false,

  // media <a href="https://www.jqueryscript.net/tags.php?/video/">video</a>
  Embed: false,

  // link
  urls: false,

  // tables
  table: false,

  // code
  removeStyles: false,
  code: false,

  // colors
  colors: [],

  // dropdowns
  fileHTML: '',
  imageHTML: '',

  // translations
  translations: {
    'title': 'Title',
    'white': 'White',
    'black': 'Black',
    'brown': 'Brown',
    'beige': 'Beige',
    'darkBlue': 'Dark Blue',
    'blue': 'Blue',
    'lightBlue': 'Light Blue',
    'darkRed': 'Dark Red',
    'red': 'Red',
    'darkGreen': 'Dark Green',
    'green': 'Green',
    'purple': 'Purple',
    'darkTurquois': 'Dark Turquois',
    'turquois': 'Turquois',
    'darkOrange': 'Dark Orange',
    'orange': 'Orange',
    'yellow': 'Yellow',
    'imageURL': 'Image URL',
    'fileURL': 'File URL',
    'linkText': 'Link text',
    'url': 'URL',
    'size': 'Size',
    'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
    'text': 'Text',
    'openIn': 'Open in',
    'sameTab': 'Same tab',
    'newTab': 'New tab',
    'align': 'Align',
    'left': 'Left',
    'center': 'Center',
    'right': 'Right',
    'rows': 'Rows',
    'columns': 'Columns',
    'add': 'Add',
    'pleaseEnterURL': 'Please enter an URL',
    'videoURLnotSupported': 'Video URL not supported',
    'pleaseSelectImage': 'Please select an image',
    'pleaseSelectFile': 'Please select a file',
    'bold': 'Bold',
    'italic': 'Italic',
    'underline': 'Underline',
    'alignLeft': 'Align left',
    'alignCenter': 'Align centered',
    'alignRight': 'Align right',
    'addOrderedList': 'Add ordered list',
    'addUnorderedList': 'Add unordered list',
    'addHeading': 'Add Heading/title',
    'addFont': 'Add font',
    'addFontColor': 'Add font color',
    'addFontSize' : 'Add font size',
    'addImage': 'Add image',
    'addVideo': 'Add video',
    'addFile': 'Add file',
    'addURL': 'Add URL',
    'addTable': 'Add table',
    'removeStyles': 'Remove styles',
    'code': 'Show HTML code',
    'undo': 'Undo',
    'redo': 'Redo',
    'close': 'Close'
  },

  // dev settings
  useSingleQuotes: false,
  height: 0,
  heightPercentage: 0,
  id: "",
  class: "",
  useParagraph: false
  
});
 
});
    function validate() {
        if($('#start_date').val() > $('#end_date').val()) {
            alert('Start date can not be greater than end date!');
            return false;
        }

        var ftype = $('#image')[0].files[0].type;

        switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/jpg':
                break;
            default:
                alert('Unsupported File!');
                return false;
        }
        
        $('#add-event-form').submit();

        // text editor
        
    }
</script>
@endsection
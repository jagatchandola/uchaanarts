@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('backend/css/richtext.min.css') }}" rel="stylesheet">
@endsection
@section('content')
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Event</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" id="edit-event-form" name="edit-event-form" action="{{ route('edit-event-post') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="event-id" value="{{ $event['id'] }}" />
                                            
                                            <div class="form-group">
                                                <img src="{{ \App\Helpers\Helper::getImage($event['eurl'].'/'.$event['banner'], 3) }}" width="100" height="100" />
                                                <input class="form-control" type="file" name="image" id="image" value="" @if(empty($event['banner'])) required @endif>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Type</label>
                                                <select class="form-control" name="category">
                                                    <option value="exhibition" @if($event['category'] == 'exhibition') selected @endif>Exhibition</option>
                                                    <option value="workshop" @if($event['category'] == 'workshop') selected @endif>Workshop</option>
                                                    <option value="seminar" @if($event['category'] == 'seminar') selected @endif>Seminar</option>
                                                    <option value="art_camp" @if($event['category'] == 'art_camp') selected @endif>Art Camp</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Title</label>
                                                <input class="form-control" name="event-name" value="{{ $event['etitle'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Venue<small>City name is mandatory</small></label>
                                                <textarea class="form-control" type="textarea" name="venue" value="" required>{{ $event['venue'] }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>About Event</label>
                                                <textarea class="form-control content1" type="textarea" name="about" required>{{ $event['about'] }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $event['start_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $event['end_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Date to Participation</label>
                                                <input class="form-control" type="date" name="last_date" id="last_date" value="{{ $event['last_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Event Fees</label>
                                                <input class="form-control" type="text" name="event_fees" value="{{ $event['fees'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Additional Entry Fees</label>
                                                <input class="form-control" type="text" name="event_fees1" value="{{ $event['fees1'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" @if($event['shide'] == 1) checked @endif>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" @if($event['shide'] == 0) checked @endif>Inactive
                                                </label>                                                
                                            </div>

                                            <input type="hidden" name="path" value="{{ $event['eurl'] }}">
                                            
                                            <button type="button" class="btn btn-primary" onclick="validate()">Submit</button>
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

  // media 
  //<a href="https://www.jqueryscript.net/tags.php?/video/">video</a>Embed: false,

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

        if ($('#image').val() != '') {
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
        }
        $('#edit-event-form').submit();
    }
</script>        
@endsection

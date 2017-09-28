<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield("title")
        </title>
        <link href="{{asset('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
        rel="stylesheet">
    </head>
    
    <body>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    All form elements
                    <small>
                        With custom checbox and radion elements.
                    </small>
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up">
                        </i>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="fa fa-wrench">
                        </i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#">
                                Config option 1
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Config option 2
                            </a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times">
                        </i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Normal
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Help text
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                            <span class="help-block m-b-none">
                                A block of help text that breaks onto a new line and may extend beyond
                                one line.
                            </span>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Password
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Placeholder
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="placeholder">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Disabled
                        </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" placeholder="Disabled input here..."
                            disabled="">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Static control
                        </label>
                        <div class="col-lg-10">
                            <p class="form-control-static">
                                email@example.com
                            </p>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Checkboxes and radios
                            <br>
                            <small class="text-navy">
                                Normal Bootstrap elements
                            </small>
                        </label>
                        <div class="col-sm-10">
                            <div>
                                <label>
                                    <input type="checkbox" value="">
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                    checked="">
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else and selecting it will deselect option
                                    one
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Inline checkboxes
                        </label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" value="option1">
                                a
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" value="option2">
                                b
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox3" value="option3">
                                c
                            </label>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Checkboxes &amp; radios
                            <br>
                            <small class="text-navy">
                                Custom elements
                            </small>
                        </label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <label>
                                    <div class="icheckbox_square-green" style="position: relative;">
                                        <input type="checkbox" value="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option one
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="icheckbox_square-green checked" style="position: relative;">
                                        <input type="checkbox" checked="" value="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option two checked
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="icheckbox_square-green checked disabled" style="position: relative;">
                                        <input type="checkbox" checked="" disabled="" value="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option three checked and disabled
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="icheckbox_square-green disabled" style="position: relative;">
                                        <input type="checkbox" disabled="" value="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option four disabled
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="iradio_square-green" style="position: relative;">
                                        <input type="radio" name="a" value="option1" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option one
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="iradio_square-green checked" style="position: relative;">
                                        <input type="radio" name="a" value="option2" checked="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option two checked
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="iradio_square-green checked disabled" style="position: relative;">
                                        <input type="radio" value="option2" checked="" disabled="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option three checked and disabled
                                </label>
                            </div>
                            <div class="i-checks">
                                <label>
                                    <div class="iradio_square-green disabled" style="position: relative;">
                                        <input type="radio" name="a" disabled="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                        </ins>
                                    </div>
                                    <i>
                                    </i>
                                    Option four disabled
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Inline checkboxes
                        </label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline i-checks">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" value="option1" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                    </ins>
                                </div>
                                a
                            </label>
                            <label class="checkbox-inline i-checks">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" value="option2" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                    </ins>
                                </div>
                                b
                            </label>
                            <label class="checkbox-inline i-checks">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" value="option3" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">
                                    </ins>
                                </div>
                                c
                            </label>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Select
                        </label>
                        <div class="col-sm-10">
                            <select name="account" class="form-control m-b">
                                <option>
                                    option 1
                                </option>
                                <option>
                                    option 2
                                </option>
                                <option>
                                    option 3
                                </option>
                                <option>
                                    option 4
                                </option>
                            </select>
                            <div class="col-lg-4 m-l-n">
                                <select multiple="" class="form-control">
                                    <option>
                                        option 1
                                    </option>
                                    <option>
                                        option 2
                                    </option>
                                    <option>
                                        option 3
                                    </option>
                                    <option>
                                        option 4
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">
                            Input with success
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group has-warning">
                        <label class="col-sm-2 control-label">
                            Input with warning
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group has-error">
                        <label class="col-sm-2 control-label">
                            Input with error
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Control sizing
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-lg m-b" placeholder=".input-lg">
                            <input type="text" class="form-control m-b" placeholder="Default input">
                            <input type="text" class="form-control input-sm" placeholder=".input-sm">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Column sizing
                        </label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder=".col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder=".col-md-3">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder=".col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Input groups
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <span class="input-group-addon">
                                    @
                                </span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group m-b">
                                <input type="text" class="form-control">
                                <span class="input-group-addon">
                                    .00
                                </span>
                            </div>
                            <div class="input-group m-b">
                                <span class="input-group-addon">
                                    $
                                </span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon">
                                    .00
                                </span>
                            </div>
                            <div class="input-group m-b">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio">
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Button addons
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        Go!
                                    </button>
                                </span>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        Go!
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            With dropdowns
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                        Action
                                        <span class="caret">
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">
                                                Action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Another action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Something else here
                                            </a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#">
                                                Separated link
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                        Action
                                        <span class="caret">
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#">
                                                Action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Another action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Something else here
                                            </a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#">
                                                Separated link
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Segmented
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white" tabindex="-1">
                                        Action
                                    </button>
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret">
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">
                                                Action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Another action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Something else here
                                            </a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#">
                                                Separated link
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white" tabindex="-1">
                                        Action
                                    </button>
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret">
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#">
                                                Action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Another action
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Something else here
                                            </a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#">
                                                Separated link
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-white">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{asset('/admin/js/jquery-2.1.1.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('extension/layer/layer.js')}}">
        </script>
        <script src="{{asset('/admin/js/bootstrap.min.js')}}">
        </script>
        <script src="{{asset('/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}">
        </script>
        <script src="{{asset('/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}">
        </script>
        <!-- Custom and plugin javascript -->
        <script src="{{asset('/admin/js/inspinia.js')}}">
        </script>
        <script src="{{asset('/admin/js/plugins/pace/pace.min.js')}}">
        </script>
        <!-- iCheck -->
        <script src="{{asset('/admin/js/plugins/iCheck/icheck.min.js')}}">
        </script>
        <script>
            $(document).ready(function() {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    </body>

</html>
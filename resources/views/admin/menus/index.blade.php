@extends('themes.limitless.layouts.default')

@section('title', 'All Menus')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/extensions/cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/trees/fancytree_childcounter.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.menus.includes.pageheader')
@endsection

@section('content')

<!-- Table tree -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">Menus</h6>
    </div>

    @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <div class="table-responsive">
        <table class="table table-condensed table-bordered tree-table">
            <thead>
                <tr>
                    <th style="width: 5px;"></th>
                    <th style="width: 30px;">#</th>
                    <th>Title</th>
                    <th style="width: 40px;">Link</th>
                    <th style="width: 40px;">Group</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!-- /table tree -->

<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this record?</p>
            </div>

            <div class="modal-footer">
                <form method="post" id="delete_form" action="/admin/menus/0">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /default modal -->
@endsection

@section('script')
<script>
    window.delete_confirm = function(id) {
        $("#delete_form").attr('action', '/admin/menus/'+id);
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //
        // Table tree
        //

        $(".tree-table").fancytree({
            extensions: ["table", "dnd"],
            checkbox: false,
            table: {
                indentation: 20,      // indent 20px per node level
                nodeColumnIdx: 2,     // render the node title into the 2nd column
                checkboxColumnIdx: 0  // render the checkboxes into the 1st column
            },
            dnd: {
                autoExpandMS: 500,
                focusOnClick: true,
                preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                dragStart: function(node, data) {
                    return true;
                },
                dragEnter: function(node, data) {
                    return ["before", "after"];
                },
                dragDrop: function(node, data) {
                    var change = {
                        mode: data.hitMode,
                        other: data.node.data.id,
                        node: data.otherNode.data.id
                    }

                    $.ajax({
                        type: 'PUT',
                        url: '{{ route('admin.menus.tree.update') }}',
                        data: change,
                        success: function () {
                            // This function MUST be defined to enable dropping of items on the tree.
                            data.otherNode.moveTo(node, data.hitMode);
                        }
                    });
                }
            },
            source: {
                url: "/admin/menus/tree"

            },
            lazyLoad: function(event, data) {
                data.result = {url: "/admin/menus/tree"}
            },
            renderColumns: function(event, data) {
                var node = data.node;

                $tdList = $(node.tr).find(">td");

                // (index #0 is rendered by fancytree by adding the checkbox)
                $tdList.eq(1).text(node.getIndexHier()).addClass("alignRight");

                $tdList.eq(3).addClass('text-left').html("<a href='" + node.data.link + "' style='display: block;max-width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>" + node.data.link + "</a>");
                $tdList.eq(4).addClass('text-left').html("<span class='label label-default label-striped'>" + node.data.group + "</a>");
                $tdList.eq(5).addClass('text-center').html(`
                    <div class='btn-group'>
                    <a href='/admin/menus/` + node.data.id + `' class='btn btn-default btn-xs'><span class='icon-eye'></span></a>
                    <a href='/admin/menus/` + node.data.id + `/edit' class='btn btn-default btn-xs'><span class='icon-pencil'></span></a>
                    <a href='#' data-toggle='modal' data-target='#modal_theme_danger' onclick='delete_confirm(` + node.data.id + `)' class='btn btn-default btn-xs'><span class='icon-trash'></span></a>
                    </div>`);

                // Style checkboxes
                $(".styled").uniform({radioClass: 'choice'});
            }
        });

        // Handle custom checkbox clicks
        $(".tree-table").delegate("input[name=like]", "click", function (e){
            var node = $.ui.fancytree.getNode(e),
            $input = $(e.target);
            e.stopPropagation(); // prevent fancytree activate for this row
            if($input.is(":checked")){
                alert("like " + $input.val());
            }
            else{
                alert("dislike " + $input.val());
            }
        });
    });
</script>
@endsection

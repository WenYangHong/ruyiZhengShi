@extends('Back.index')
@section('main')
    <div class="demoTable productCat">
        {{--<form action="">--}}
            {{--<div class="layui-inline">--}}
                {{--<input class="layui-input" name="keyword" id="demoReload" autocomplete="off" placeholder="用户名或手机号">--}}
            {{--</div>--}}
            {{--<button class="layui-btn" data-type="reload">搜索</button>--}}
        {{--</form>--}}
    </div>
    <div class="layui-form table-data">
        <table class="layui-table">
            <colgroup>
                <col width="300">
                <col width="300">
                <col width="300">
                <col width="350">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>登录账号</th>
                <th>账号角色</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td id="{{ $value->id }}">{{ $value->id }}</td>
                    <td id="{{ $value->id }}">{{ $value->admin_name }}</td>
                    <td id="{{ $value->id }}">
                        @if($value->roleid == 0)
                            超级管理员
                            @else
                            子账号
                            @endif
                    </td>
                    <td>
                        <button  class="layui-btn layui-btn-small admin_edit">修改登录信息</button>
                        <button  class="layui-btn layui-btn-small layui-btn-danger">删除账号</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        {{ $data->links() }}--}}
    </div>

@endsection

@section('js')
    <script>
        /**
         * 修改分类
         * @param id
         * @param cat_name
         */

        function edit(id,cat_name) {
            layer.prompt({title: '修改分类', formType: 3,value:cat_name}, function(value, index){
                $.post('/back/product/CatAdd',{type:0,cat_name:value,id:id},function (obj) {
                    if(obj.code == 200){
                        $('#'+id).text(value);
                    }else{
                        layer.msg("数据未改动");
                    }
                });
                layer.close(index);
            });
        }

        /**
         * 删除分类
         * @param id
         * @param cat_name
         */

        function del(id,cat_name) {
            var type = 2;
            layer.confirm('确定删除分类【'+cat_name+'】？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('/back/product/cat_del',{id:id},function (obj) {
                    if(obj.code == 200){
                        type = 1;
                        //删除对应的 tr
                    }
                    layer.msg(obj.msg,{icon:2})
                });
            });
        }
    </script>
@endsection
        <form action="{{ route('form.submit1') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>姓名</label>
                <input type="text" name="name" class="form-control" placeholder="输入标题" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" name="password" class="form-control" placeholder="输入URL" value="{{ old('url') }}">
            </div>

            <button type="submit" class="btn btn-primary">提交</button>
        </form>
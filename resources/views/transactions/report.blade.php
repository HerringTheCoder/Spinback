<html>
    <head>
        <title>
            Spinback
        </title>
    </head>
<body>
        <table class="ui celled table">
                <thead>
                <tr><th>id</th>
                    <th>price</th>
                    <th>department</th>
                </tr></thead>
                <tbody>

        @foreach($transactions as $transaction)
        <tr>
            <td data-label="id">{{$transaction->id}}</td>
            <td data-label="price">{{$transaction->price}}</td>
            <td data-label="department">{{$transaction->department->name}}</td>
            </td>
        </tr>
        @endforeach
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Spinback
        </title>
    </head>
<body>
    <table>
            <td>Sum of income: {{$income}}</td>
            <td>Sum of expenses: {{$expense}}</td>
            <td>Total balance: {{$balance}}</td>
    </table>
        <table class="ui celled table">
                <thead>
                <tr><th>id</th>
                    <th>title</th>
                    <th>seller</th>
                    <th>price</th>
                    <th>department</th>
                </tr></thead>
                <tbody>

        @foreach($transactions as $transaction)
        <tr>
            <td data-label="id">{{$transaction->id}}</td>
            <td data-label="title">{{$transaction->disc->album->title}}</td>
            <td data-label="seller">{{$transaction->user->getFullNameAttribute()}}
            <td data-label="price">{{$transaction->price}}</td>
            <td data-label="department">{{$transaction->department->name}}</td>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>

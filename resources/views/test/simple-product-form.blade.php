<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Product Form</title>
</head>
<body>
    <h2>Create Product (Simple Test)</h2>

    <form action="{{ route('test.product.store') }}" method="POST">
        @csrf

        <div>
            <label>Name EN</label>
            <input type="text" name="name_en" required>
        </div>

        <div>
            <label>Name AR</label>
            <input type="text" name="name_ar" required>
        </div>

        <div>
            <label>Category ID</label>
            <input type="number" name="category_id" required>
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div>
            <label>Description EN</label>
            <textarea name="description_en"></textarea>
        </div>

        <div>
            <label>Description AR</label>
            <textarea name="description_ar"></textarea>
        </div>

        <hr>

        <h4>Sizes:</h4>
        <div>
            <input type="text" name="sizes[0][value]" placeholder="Size (e.g. 250g)" required>
            <input type="number" step="0.01" name="sizes[0][price]" placeholder="Price" required>
        </div>
        <div>
            <input type="text" name="sizes[1][value]" placeholder="Size (e.g. 500g)">
            <input type="number" step="0.01" name="sizes[1][price]" placeholder="Price">
        </div>

        <br>
        <button type="submit">Save Product</button>
    </form>
</body>
</html>

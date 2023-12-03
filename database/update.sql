UPDATE products 
SET CategoryID = (SELECT CategoryID FROM categories WHERE products.ProductDescription = categories.CategoryName)
WHERE EXISTS (SELECT 1 FROM categories WHERE categories.CategoryName = products.ProductDescription)
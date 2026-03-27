const Api = {
    Image: {},
    Category: {},
    Trademark: {},
    Product: {},
    Warehouse: {},
    Order: {},
    Statistic: {},
    Carousel: {},
    News: {},

};
(() => {
    $.ajaxSetup({
        headers: { 
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        },
        crossDomain: true
    });
})();

//Carousel
(() => {
    Api.Carousel.GetAll = () => $.ajax({
        url: `/apip/carousel/get`,
        method: 'GET',
    });
    Api.Carousel.Store = (data) => $.ajax({
        url: `/apip/carousel/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    }); 
})();

//News
(() => {
    Api.News.GetAll = () => $.ajax({
        url: `/apip/news/get`,
        method: 'GET',
    });
    Api.News.Store = (data) => $.ajax({
        url: `/apip/news/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.News.getOne = (id) => $.ajax({
        url: `/apip/news/get-one/${id}`,
        method: 'GET',
    });
    Api.News.Update = (data) => $.ajax({
        url: `/apip/news/update`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.News.Delete = (id) => $.ajax({
        url: `/apip/news/delete/${id}`,
        method: 'GET',
    });
})();

//Category
(() => {
    Api.Category.GetAll = () => $.ajax({
        url: `/apip/category/get`,
        method: 'GET',
    });
    Api.Category.Store = (data) => $.ajax({
        url: `/apip/category/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Category.getOne = (id) => $.ajax({
        url: `/apip/category/get-one/${id}`,
        method: 'GET',
    });
    Api.Category.Update = (data) => $.ajax({
        url: `/apip/category/update`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Category.Delete = (id) => $.ajax({
        url: `/apip/category/delete/${id}`,
        method: 'GET',
    });
})();

//Trademark
(() => {
    Api.Trademark.GetAll = () => $.ajax({
        url: `/apip/trademark/get`,
        method: 'GET',
    });
    Api.Trademark.Store = (data) => $.ajax({
        url: `/apip/trademark/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Trademark.getOne = (id) => $.ajax({
        url: `/apip/trademark/get-one/${id}`,
        method: 'GET',
    });
    Api.Trademark.Update = (data) => $.ajax({
        url: `/apip/trademark/update`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Trademark.Delete = (id) => $.ajax({
        url: `/apip/trademark/delete/${id}`,
        method: 'GET',
    });
})();

//Product
(() => {
    Api.Product.GetAll = () => $.ajax({
        url: `/apip/product/get`,
        method: 'GET',
    });
    Api.Product.GetFree = () => $.ajax({
        url: `/apip/product/getfree`,
        method: 'GET',
    }); 

    Api.Product.GetDiscount = () => $.ajax({
        url: `/apip/product/get-discount`,
        method: 'GET',
    });

    Api.Product.Store = (data) => $.ajax({
        url: `/apip/product/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    
    Api.Product.getOne = (id) => $.ajax({
        url: `/apip/product/get-one/${id}`,
        method: 'GET',
    });
    Api.Product.Update = (data) => $.ajax({
        url: `/apip/product/update`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Product.UpdateDiscount = (data) => $.ajax({
        url: `/apip/product/update-discount`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Product.DeleteDiscount = (id) => $.ajax({
        url: `/apip/product/delete-discount/${id}`,
        method: 'GET',
    });
    Api.Product.Delete = (id) => $.ajax({
        url: `/apip/product/delete/${id}`,
        method: 'GET',
    });
    Api.Product.Trending = (id) => $.ajax({
        url: `/apip/product/update-trending`,
        method: 'PUT',
        dataType: 'json',
        data: {
            id: id ?? '',
        }
    });
    
})();

//Order
(() => {
    Api.Order.GetAll = (id) => $.ajax({
        url: `/apip/order/get`,
        method: 'GET',
        dataType: 'json',
        data: {
            id: id ?? '',
        }
    });
    Api.Order.GetOne = (id) => $.ajax({
        url: `/apip/order/get-one`,
        method: 'GET',
        dataType: 'json',
        data: {
            id: id ?? '',
        }
    });
    Api.Order.Update = (data) => $.ajax({
        url: `/apip/order/update`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
})();

// Image
(() => {
    Api.Image.Create = (data) => $.ajax({
        url: `/apip/post-image`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
})();

// Warehouse
(() => {
    Api.Warehouse.GetDataItem = () => $.ajax({
        url: `/apip/warehouse/get-item`,
        method: 'GET',
    });
    Api.Warehouse.GetDataHistory = () => $.ajax({
        url: `/apip/warehouse/get-history`,
        method: 'GET',
    }); 
    Api.Warehouse.Store = (data) => $.ajax({
        url: `/apip/warehouse/store`,
        method: 'POST',
        data: data,
        contentType: false,
        processData: false,
    });
    Api.Warehouse.getOne = (id) => $.ajax({
        url: `/apip/warehouse/get-ware-one/${id}`,
        method: 'GET',
    });
})();

// Statistic
(() => {
    Api.Statistic.getTotal = () => $.ajax({
        url: `/apip/statistic/get-total`,
        method: 'GET',
    });
    Api.Statistic.getBestSale = () => $.ajax({
        url: `/apip/statistic/get-best-sale`,
        method: 'GET',
    });
    Api.Statistic.getCustomerBuy = () => $.ajax({
        url: `/apip/statistic/get-customer`,
        method: 'GET',
    });
})();


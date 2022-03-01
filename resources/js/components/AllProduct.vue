<template>
    <div>
     <Navbar/>
<div class="wrapper">
 

  <div class="content-wrapper">
      <div class="container">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Desc</th>
                    <th>Category</th>
                    <th>Image</th>
                   
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for='cat in categories' :key='cat.id'>
                    <td>{{cat.id}}</td>
                    <td>{{cat.name}}</td>
                    <td>{{cat.price}}</td>
                    <td>{{cat.desc}}</td>
                    <td><img width="40px" :src="'http://localhost:8000/products/'+cat.image"></td>
                    <td>{{cat.category.name}}</td>
                   
                    <td>{{cat.created_at}}</td>
                    <td><a @click="deletee(cat.id)" class="btn btn-danger btn-sm">Delete</a></td>
                  
                  </tr>
                  
                
                  </tbody>
          
                </table>
              </div>
              <!-- /.card-body -->
            </div>

    </div>
    </div>
</div>
    </div>

</template>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script>

 $(document).ready(function() {
    $('#example').DataTable();
});


import Navbar from './Navbar.vue'
    export default {
        components:{
            Navbar
        },
      data() {
            return {
                categories: [],
              
            }
        },
        methods: {
 deletee:function(e)
        {
        
          let tokenStr = localStorage.getItem("access_token");
                 this.axios
                    .get('http://localhost:8000/api/delete_product/'+e, {
                headers: {
                    "Authorization": `Bearer ${tokenStr}`
                }
            }).then(function (res) {
                    
                   
                     
                    this.showBlogs()
                   
                    
                }.bind(this));
          
                    },

          
            showBlogs: function () {
               let tokenStr = localStorage.getItem("access_token");
                 this.axios
                    .get('http://localhost:8000/api/all_products', {
                headers: {
                    "Authorization": `Bearer ${tokenStr}`
                }
            }).then(function (res) {
                    
                   
                      this.categories = res.data.data;
                    console.log('ye hai',this.categories);
                   
                    
                }.bind(this));
            }
        },
        created: function () {
            this.showBlogs()
        },


       
        
        
    }

</script>
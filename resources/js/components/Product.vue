<template>
  <div>
       <Navbar/>
      <div class="wrapper">
 

  <div class="content-wrapper">
        <section class="content">
      <div class="container">
        <div class="row justify-content-center mt-5">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="login" enctype="multipart/form-data">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Product Name</label>
                    <input v-model="product.name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input v-model="product.price" type="text" class="form-control" id="exampleInputPassword1" placeholder="Price">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input v-model="product.desc" type="text" class="form-control" id="exampleInputPassword1" placeholder="Desc">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                   <input type="file" class="form-control" v-on:change="onChange">
                  </div>

                   <div class="form-group">
                     <label for="exampleInputPassword1">Select Category</label>
                   <select v-model="product.category_id" class="form-control">
                     <option>Select Category</option>
                     
                    <option v-for="cat in categories" :value="cat.id">
                    {{ cat.name }}
                    </option>
                </select>
                  </div>


                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- /.card -->

          </div>
        </div>
      </div>
        </section>
  </div>
      </div>
  </div>
</template>

<script>
import Navbar from './Navbar.vue';
export default {
     components:{
    Navbar
},
    
     data() {
            return {
                product: {
                   
                    name:'',
                    price:'',
                    desc:'',
                    image:'',
                    category_id:''
                   
                    // image:''
                },
                categories: [],
                 
              
            }
        },

        created: function () {
            this.showBlogs()
        },
         methods: {

            onChange(e) {
                this.product.image = e.target.files[0];
            },
              showBlogs: function () {
               let tokenStr = localStorage.getItem("access_token");
                 this.axios
                    .get('http://localhost:8000/api/all_categories', {
                headers: {
                    "Authorization": `Bearer ${tokenStr}`
                }
            }).then(function (res) {
                    console.log(res.data.data);
                    if(res.data.status==true)
                    {
                      this.categories = res.data.data;
                    console.log('cat assign ho gai hai',this.categories);
                    }
                    
                }.bind(this));
            },



             onImageChange(e){
                console.log(e.target.files[0]);
                // this.product.image = e.target.files[0];
            },
            login() {
              console.log(this.product);

                 let formData = new FormData();
                // formData.append('image', this.product.image);
                formData.append('name', this.product.name);
                formData.append('price', this.product.price);
                formData.append('desc', this.product.desc);
                formData.append('image', this.product.image);
                formData.append('category_id',this.product.category_id);

                 let tokenStr = localStorage.getItem("access_token");

                  const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                this.axios
                    .post('http://localhost:8000/api/addproduct', formData, {
                headers: {
                    "Authorization": `Bearer ${tokenStr}`
                }
            })
                    .then(response => {
                        
                       
                      console.log(response);
                      if(response.data.status==true)
                      {
                        this.$router.push({name: 'allproducts'});
                         console.log('status ok hai yar');
                       
                        // this.$router.push("/product").catch(()=>{});
                      }
                      else
                      {
                        if(response.data.message.name)
                        {
                          alert(response.data.message.name);
                        }

                        if(response.data.message.desc)
                        {
                          alert(response.data.message.desc);
                        }

                        if(response.data.message.price)
                        {
                          alert(response.data.message.price);
                        }

                         if(response.data.message.category_id)
                        {
                          alert(response.data.message.category_id);
                        }
                        
                      }

                        
                      
                     
                    
                  
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }

}
</script>

<style>

</style>
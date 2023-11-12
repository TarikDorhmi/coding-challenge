<template>
    <div>
        <h2>Products</h2>

        <router-link to="" class="btn btn-primary">Create New Product</router-link>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        products: Array,
    },
    data() {
        return {
            products: [],
        };
    },

    created() {
        axios
            .get('http://localhost:8000/api/products')
            .then(response => (this.products = response.data))
            .catch(error => console.log(error));
    },
};
</script>

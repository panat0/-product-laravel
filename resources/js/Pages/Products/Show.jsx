import { Link } from '@inertiajs/react';

export default function Show({ product }) {
    return (
        <>
                <div className="bg-black text-white py-2 text-center font-bold py-3">
                    <ul className='flex justify-center w-full space-x-4'>
                        <li>Home</li>
                        <li>About</li>
                        <li>List</li>
                    </ul>
                </div>

                <div className='text-center font-bold text-3xl mt-2  '>
                    <h1>Product</h1>
                </div>

            <div className="container mx-auto py-8 px-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div className="relative">
                        <img
                            src={product.image}
                            alt={product.name}
                            className="w-full h-[450px] object-cover rounded-lg shadow-lg"
                        />
                    </div>

                    <div>
                        <h1 className="text-3xl font-bold text-gray-800 mb-4">{product.name}</h1>
                        <p className="text-gray-600 mb-4">{product.description}</p>

                        <div className="flex items-center mb-6">
                            <span className="text-2xl font-bold text-green-500">
                                ${product.price}
                            </span>

                        </div>

                        <div className="flex space-x-4 mb-8">
                            <button
                                className="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition shadow-md"
                            >
                                 Add to Cart
                            </button>
                            <button
                                className="bg-black text-white px-6 py-3 rounded-lg hover:bg-red-600 transition shadow-md"
                            >
                                 Buy Now
                            </button>
                        </div>

                        <Link
                            href="/products"
                            className="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition"
                        >
                            Back to All Products
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );
}

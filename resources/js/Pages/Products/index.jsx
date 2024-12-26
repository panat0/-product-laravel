import { Link } from '@inertiajs/react';

export default function Index({ products }) {
    return (
        <>
            <div className='bg-gray-300'>
                <div className="bg-black text-white py-2 text-center font-bold py-3">
                    <ul className='flex justify-center w-full space-x-4'>
                        <li>Home</li>
                        <li>About</li>
                        <li>List</li>
                    </ul>
                </div>

                <div className='text-center font-bold text-3xl mt-2  '>
                    <h1>Product List</h1>
                </div>

                <div className='container mx-auto py-6 px-4'>

                    <div className='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6'>
                        {products.map((product) => ( //เข้าถึงข้อมูล
                            <div
                                key={product.id}
                                className='border rounded-lg overflow-hidden shadow-md  bg-white'
                            >
                                <Link href={`/products/${product.id}`}>
                                    <div className="relative p-4 ">
                                        <img
                                            src={product.image}
                                            alt={product.name}
                                            className="w-full h-48 object-cover rounded-lg"
                                        />

                                    </div>

                                    <div className="p-4">
                                        <h2 className="text-lg font-semibold text-gray-800 mb-2 truncate">
                                            {product.name}
                                        </h2>
                                        <p className="text-green-600 text-xl font-bold">
                                            ${product.price}
                                        </p>

                                    </div>

                                    <div className="p-4 pt-0 flex justify-between items-center">
                                        <button
                                            className="bg-black text-white px-4 py-2 rounded-lg hover:bg-green-600 transition w-full"
                                        >
                                            Buy Now
                                        </button>

                                    </div>
                                </Link>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </>
    );
}

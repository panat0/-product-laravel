import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/react';
import Chirp from '@/Components/Chirp';

export default function Index({ auth, chirps }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        message: '',
    });

    {/*
    data: เก็บข้อมูลฟอร์ม (ในที่นี้คือข้อความที่จะโพสต์)
    setData: ฟังก์ชันสำหรับอัปเดตค่าข้อมูลในฟอร์ม
    post: ฟังก์ชันสำหรับส่งคำขอแบบ POST ไปยังเซิร์ฟเวอร์
    processing: เป็น true ระหว่างการส่งคำขอ (เพื่อปิดปุ่มชั่วคราว)
    reset: รีเซ็ตค่าฟอร์มหลังจากส่งเสร็จ
    errors: เก็บข้อผิดพลาดที่ได้จากเซิร์ฟเวอร์
    */}

    const submit = (e) => {
        e.preventDefault();
        post(route('chirps.store'), { onSuccess: () => reset() });
    };

    {/*
    e.preventDefault(): ป้องกันการรีโหลดหน้าเว็บเมื่อส่งฟอร์ม
    post(route('chirps.store')): ส่งข้อมูลไปยังเส้นทาง chirps.store ใน Laravel เพื่อบันทึกข้อความลงฐานข้อมูล
    { onSuccess: () => reset() }: รีเซ็ตฟอร์มเมื่อส่งสำเร็จ
    */}

    return (
        <AuthenticatedLayout>
            <Head title="Chirps" />

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <textarea //ช่องสำหรับให้ผู้ใช้พิมพ์ข้อความ
                        value={data.message}
                        placeholder="What's on your mind?"
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        onChange={e => setData('message', e.target.value)} // อัปเดตค่า data.message ทุกครั้งที่มีการพิมพ์
                    ></textarea>
                    <InputError message={errors.message} className="mt-2" /> {/*/แสดงข้อความข้อผิดพลาดหากมี*/}
                    <PrimaryButton className="mt-4" disabled={processing}>Chirp</PrimaryButton> {/*/ปุ่มสำหรับส่งข้อความ (จะถูกปิดการใช้งานขณะ processing)*/}
                </form>
                <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    {chirps.map(chirp =>
                        <Chirp key={chirp.id} chirp={chirp} />
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

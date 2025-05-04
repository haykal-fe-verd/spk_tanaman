import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import GuestLayout from '@/layouts/guest-layout';
import { Kriteria, PageProps } from '@/types';
import { router, useForm, usePage } from '@inertiajs/react';
import { Loader2 } from 'lucide-react';
import React from 'react';
import { toast } from 'sonner';

interface AhpPageProps {
    kriteria: Kriteria[];
    perbandingan: Record<string, Record<string, string>>;
}

type AhpForm = {
    perbandingan: Record<string, Record<string, string>>;
};

function AhpPage({ kriteria, perbandingan }: AhpPageProps) {
    // hooks
    const { props } = usePage<PageProps>();

    const { data, setData, post, processing, errors, reset } = useForm<AhpForm>({
        perbandingan: perbandingan || {},
    });

    // events
    const handleSubmit: React.FormEventHandler = (e) => {
        e.preventDefault();
        post(route('ahp.store'), {
            onSuccess: () => {
                toast.success('Data berhasil disimpan');
                reset();
            },
        });
    };

    const handleChange = (value: string, k1Id: string, k2Id: string) => {
        const updated = { ...data.perbandingan };

        if (!updated[k1Id]) {
            updated[k1Id] = {};
        }

        updated[k1Id][k2Id] = value;

        setData('perbandingan', updated);
    };

    // effects
    React.useEffect(() => {
        if (props?.sessions?.success) {
            toast.success(props.sessions.success);
        }
    }, [props?.sessions?.success]);

    return (
        <GuestLayout title="AHP">
            <div className="w-full p-5">
                <form onSubmit={handleSubmit} className="w-full space-y-5">
                    <Table>
                        <TableHeader>
                            <TableRow className="border">
                                <TableHead className="border text-center font-bold">Kriteria</TableHead>
                                {kriteria.map((item) => (
                                    <TableHead key={item.id} className="w-30 border text-center font-bold text-wrap">
                                        {item.nama}
                                    </TableHead>
                                ))}
                            </TableRow>
                        </TableHeader>
                        <TableBody className="border">
                            {kriteria.map((k1, i) => (
                                <TableRow key={k1.id}>
                                    <TableCell className="font-bold">{k1.nama}</TableCell>
                                    {kriteria.map((k2, j) => (
                                        <TableCell key={k2.id} className="border text-center font-bold">
                                            {i < j ? (
                                                <>
                                                    <Select
                                                        name={`perbandingan[${k1.id}][${k2.id}]`}
                                                        onValueChange={(value) => {
                                                            handleChange(value, k1.id, k2.id);
                                                        }}
                                                        defaultValue={
                                                            data.perbandingan[k1.id]?.[k2.id]?.toString() ?? perbandingan[k1.id]?.[k2.id]?.toString()
                                                        }
                                                    >
                                                        <SelectTrigger className="w-[150px]">
                                                            <SelectValue placeholder="Pilih Nilai" />
                                                        </SelectTrigger>
                                                        <SelectContent>
                                                            {[...Array(9)].map((_, n) => (
                                                                <SelectItem key={n + 1} value={(n + 1).toString()}>
                                                                    {n + 1}
                                                                </SelectItem>
                                                            ))}
                                                        </SelectContent>
                                                    </Select>
                                                    <InputError message={errors.perbandingan?.[Number(k1.id)]?.[Number(k2.id)]} />
                                                </>
                                            ) : i === j ? (
                                                <span className="text-center font-bold">1</span>
                                            ) : (
                                                <span className="text-primary text-center font-bold">
                                                    {perbandingan[k1.id]?.[k2.id]
                                                        ? parseFloat(perbandingan[k1.id][k2.id]).toFixed(5)
                                                        : perbandingan[k2.id]?.[k1.id]
                                                          ? (1 / parseFloat(perbandingan[k2.id][k1.id])).toFixed(5)
                                                          : '-'}
                                                </span>
                                            )}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>

                    <div className="flex items-center gap-5">
                        <Button type="submit" disabled={processing} className="inline-flex w-fit items-center justify-center gap-2">
                            {processing && <Loader2 className="animate-spin" />}
                            Simpan
                        </Button>

                        <Button type="button" onClick={() => router.post(route('ahp.bobot'))} variant="secondary">
                            Hitung Bobot AHP
                        </Button>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}

export default AhpPage;

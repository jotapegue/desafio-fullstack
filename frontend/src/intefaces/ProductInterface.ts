import type { CategoryInterface } from "./CategoryInterface";

export interface ProductInterface
{
  category?: CategoryInterface;
  categories?: CategoryInterface[]
  category_id?: number,
  price: number | string;
  due_in: string;
  name: string;
  description: string;
  image?: File;
  photo?: string
  id?: number,
}

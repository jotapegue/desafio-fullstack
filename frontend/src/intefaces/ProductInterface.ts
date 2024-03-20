import type { CategoryInterface } from "./CategoryInterface";

export interface ProductInterface
{
  category?: {
    id: number,
    name: string
  };
  categories?: CategoryInterface[]
  category_id?: number,
  price: number;
  due_in: string;
  name: string;
  description: string;
  image: string | File;
  id?: number,
}

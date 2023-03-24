import { EyeInvisibleOutlined } from "@ant-design/icons";
import { Avatar, Button, Card, message } from "antd";
import React, { useState } from "react";
import { couponService } from "../services/coupon.service";
const { Meta } = Card;

const CouponCard = ({ item, onCouponHidden }) => {
  const [loading, setLoading] = useState(false);
  const [messageApi, contextHolder] = message.useMessage();

  const hideCoupon = async (id) => {
    try {
      setLoading(true);
      const response = await couponService.hide(id);
      if (response.status) {
        onCouponHidden(id);
      }
    } catch (error) {
      messageApi.open({
        type: "error",
        content: error.message || "Something went wrong!",
      });
    } finally {
      setLoading(false);
    }
  };

  const handleHideCoupon = (id) => {
    hideCoupon(id);
  };

  return (
    <>
      {contextHolder}
      <Card
        className="coupon-card"
        cover={
          <img
            alt={item.title}
            src={`https://assets.scoupy.nl/images/${item.image}`}
          />
        }
        actions={[
          <Button
            loading={loading}
            onClick={() => {
              handleHideCoupon(item.id_coupon);
            }}
          >
            <EyeInvisibleOutlined /> Hide
          </Button>,
        ]}
      >
        <Meta
          avatar={
            <Avatar
              src={`https://assets.scoupy.nl/images/${item.client_icon}`}
            />
          }
          title={item.title}
          description={item.retailer_availability_label || ""}
        />
      </Card>
    </>
  );
};

export default CouponCard;
